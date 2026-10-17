<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\TuitionFee;
use App\Support\CurrencyCodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public const LEVELS = ['Certificate', 'Diploma', 'Bachelor', 'Master', 'PhD'];

    public const MODES = ['On Campus', 'Online', 'Hybrid'];

    public const FEE_PERIODS = ['Year', 'Semester', 'Course', 'Other'];

    public const DURATION_UNITS = ['weeks', 'months', 'years'];

    private const MESSAGES = [
        'university_id.required' => 'Please choose a university.',
        'university_id.exists' => 'Please choose a university from the list.',
        'tuition_amount.numeric' => 'The tuition fee must be a number, for example 38500.',
        'tuition_currency.required_with' => 'Please choose a currency for the tuition fee.',
        'tuition_currency.in' => 'Please choose a currency from the list.',
        'duration_value.numeric' => 'The duration must be a number, for example 4 or 1.5.',
        'duration_value.gt' => 'The duration must be more than 0.',
        'duration_value.max' => 'The duration is too long. Please check the number.',
        'duration_value.regex' => 'The duration can have at most one decimal place, for example 1.5.',
        'duration_unit.required_with' => 'Please choose weeks, months or years for the duration.',
        'duration_unit.in' => 'Please choose weeks, months or years for the duration.',
        'course_image.image' => 'The course image must be an image file.',
        'course_image.mimes' => 'The course image must be a JPG, PNG, WEBP or GIF image.',
        'course_image.max' => 'The course image must not be larger than 2 MB.',
    ];

    public function index()
    {
        $courses = Course::with([
            'university.country',
            'tuitionFees',
            'intakes',
        ])
            ->orderBy('course_name')
            ->paginate(20);

        return view(
            'admin.courses',
            compact('courses')
        );
    }

    public function create()
    {
        return redirect()->route('admin.courses.index');
    }

    public function store(Request $request)
    {
        $this->tidyInput($request);

        $validated = $request->validate(
            $this->rules(),
            self::MESSAGES
        );

        $fields = $this->courseFields($request, $validated);

        if ($request->hasFile('course_image')) {
            $fields['course_image'] = $request->file('course_image')
                ->store('course-images', 'public');
        }

        DB::transaction(function () use ($fields, $validated) {
            $course = Course::create($fields);

            $this->saveTuition($course, $validated);
        });

        return redirect()
            ->route('admin.courses.index')
            ->with(
                'success',
                'Course created successfully.'
            );
    }

    public function show(Course $course)
    {
        return redirect()->route('admin.courses.index');
    }

    public function edit(Course $course)
    {
        return redirect()->route('admin.courses.index');
    }

    public function update(
        Request $request,
        Course $course
    ) {
        $this->tidyInput($request);

        $validated = $request->validate(
            $this->rules(),
            self::MESSAGES
        );

        $fields = $this->courseFields($request, $validated);
        $oldImage = $course->course_image;

        if ($request->hasFile('course_image')) {
            // New image uploaded: save it and replace the old one.
            $fields['course_image'] = $request->file('course_image')
                ->store('course-images', 'public');
        } elseif ($request->boolean('remove_image')) {
            $fields['course_image'] = null;
        }

        DB::transaction(function () use ($fields, $validated, $course) {
            $course->update($fields);

            $this->saveTuition($course, $validated);
        });

        if (
            $oldImage &&
            array_key_exists('course_image', $fields) &&
            $fields['course_image'] !== $oldImage
        ) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()
            ->route('admin.courses.index')
            ->with(
                'success',
                'Course updated successfully.'
            );
    }

    /**
     * Delete a course permanently, together with its fees, intakes,
     * requirements and the scholarships written for this course only.
     * Refused when students already use the course, so their applications,
     * recommendations and fund reports are never damaged.
     * (To hide a course without deleting it, set its status to Inactive.)
     */
    public function destroy(Course $course)
    {
        $name = $course->course_name;
        $courseId = $course->course_id;
        $intakeIds = DB::table('course_intakes')->where('course_id', $courseId)->pluck('intake_id');

        $studentLinks =
            DB::table('applications')->where('preferred_course_id', $courseId)->count()
            + DB::table('recommendations')->where('course_id', $courseId)->count()
            + DB::table('fund_requirements')->where('selected_course_id', $courseId)->count()
            + ($intakeIds->isNotEmpty()
                ? DB::table('applications')->whereIn('preferred_intake_id', $intakeIds)->count()
                : 0);

        if ($studentLinks > 0) {
            return redirect()
                ->route('admin.courses.index')
                ->with(
                    'error',
                    '"' . $name . '" can\'t be deleted because students have applications, '
                    . 'recommendations or fund reports linked to it. '
                    . 'Set it to Inactive instead to hide it from the website.'
                );
        }

        $image = $course->course_image;

        DB::transaction(function () use ($course, $courseId) {
            // Scholarships and document requirements written for this course only.
            DB::table('scholarships')->where('course_id', $courseId)->delete();
            DB::table('required_documents')->where('course_id', $courseId)->delete();

            // Deleting the course also removes its fees, intakes and requirements.
            $course->delete();
        });

        if ($image) {
            Storage::disk('public')->delete($image);
        }

        return redirect()
            ->route('admin.courses.index')
            ->with(
                'success',
                'Course "' . $name . '" deleted.'
            );
    }

    /**
     * Validation rules shared by add and edit.
     */
    private function rules(): array
    {
        return [
            'university_id' => [
                'required',
                'exists:universities,university_id'
            ],
            'course_name' => [
                'required',
                'string',
                'max:255'
            ],
            'course_level' => [
                'required',
                'in:' . implode(',', self::LEVELS)
            ],
            'field_of_study' => [
                'nullable',
                'string',
                'max:150'
            ],
            // Duration = a number + weeks/months/years, saved as e.g. "4 years".
            'duration_value' => [
                'bail',
                'nullable',
                'numeric',
                'gt:0',
                'max:520',
                'regex:/^\d+(\.\d)?$/',
                // Sensible limits per unit: 10 years, 120 months or 520 weeks.
                function ($attribute, $value, $fail) {
                    $limits = ['years' => 10, 'months' => 120, 'weeks' => 520];
                    $unit = request('duration_unit');

                    if (isset($limits[$unit]) && (float) $value > $limits[$unit]) {
                        $fail('A course can\'t be longer than ' . $limits[$unit] . ' ' . $unit . '. Please check the duration.');
                    }
                },
            ],
            'duration_unit' => [
                'nullable',
                'required_with:duration_value',
                'in:' . implode(',', self::DURATION_UNITS)
            ],
            'study_mode' => [
                'required',
                'in:' . implode(',', self::MODES)
            ],
            'description' => [
                'nullable',
                'string'
            ],
            'is_active' => [
                'boolean'
            ],

            // Optional tuition fee, saved in the tuition_fees table.
            'tuition_amount' => [
                'nullable',
                'numeric',
                'min:0',
                'max:9999999999'
            ],
            'tuition_currency' => [
                'nullable',
                'required_with:tuition_amount',
                'in:' . implode(',', CurrencyCodes::codes())
            ],
            'tuition_period' => [
                'nullable',
                'in:' . implode(',', self::FEE_PERIODS)
            ],

            // Optional picture shown on the public course card. SVG is not allowed for safety.
            'course_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,gif',
                'max:2048'
            ],
        ];
    }

    /**
     * The fields that belong to the courses table.
     */
    private function courseFields(Request $request, array $validated): array
    {
        $fields = collect($validated)->only([
            'university_id',
            'course_name',
            'course_level',
            'field_of_study',
            'study_mode',
            'description',
        ])->all();

        $fields['duration'] = $this->durationText(
            $validated['duration_value'] ?? null,
            $validated['duration_unit'] ?? null
        );

        $fields['is_active'] = $request->boolean('is_active');

        return $fields;
    }

    /**
     * Tidy the form before checking it: currency in capitals ("lkr" -> "LKR"),
     * duration unit in lower case.
     */
    private function tidyInput(Request $request): void
    {
        $request->merge([
            'tuition_currency' => $request->filled('tuition_currency')
                ? strtoupper(trim($request->input('tuition_currency')))
                : null,
            'duration_unit' => $request->filled('duration_unit')
                ? strtolower(trim($request->input('duration_unit')))
                : null,
        ]);
    }

    /**
     * Turn the number + unit into the saved text, e.g. (4, years) -> "4 years",
     * (1, years) -> "1 year", (1.5, years) -> "1.5 years". Empty -> null.
     */
    private function durationText($value, ?string $unit): ?string
    {
        if ($value === null || $value === '' || !$unit) {
            return null;
        }

        $number = (float) $value;
        $shown = rtrim(rtrim(number_format($number, 1, '.', ''), '0'), '.');
        $word = $number == 1 ? rtrim($unit, 's') : $unit;

        return $shown . ' ' . $word;
    }

    /**
     * Save the course's main tuition fee (its most recent fee row).
     * An empty amount removes that fee.
     */
    private function saveTuition(Course $course, array $validated): void
    {
        $fee = $course->tuitionFees()
            ->orderByDesc('tuition_fee_id')
            ->first();

        $amount = $validated['tuition_amount'] ?? null;

        if ($amount === null || $amount === '') {
            $fee?->delete();

            return;
        }

        $data = [
            'amount' => $amount,
            'currency' => strtoupper(trim($validated['tuition_currency'])),
            'fee_period' => $validated['tuition_period'] ?? 'Year',
        ];

        if ($fee) {
            $fee->update($data);
        } else {
            TuitionFee::create($data + ['course_id' => $course->course_id]);
        }
    }
}