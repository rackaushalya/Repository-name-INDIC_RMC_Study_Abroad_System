<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\TuitionFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public const LEVELS = ['Certificate', 'Diploma', 'Bachelor', 'Master', 'PhD'];

    public const MODES = ['On Campus', 'Online', 'Hybrid'];

    public const FEE_PERIODS = ['Year', 'Semester', 'Course', 'Other'];

    private const MESSAGES = [
        'university_id.required' => 'Please choose a university.',
        'university_id.exists' => 'Please choose a university from the list.',
        'tuition_amount.numeric' => 'The tuition fee must be a number, for example 38500.',
        'tuition_currency.required_with' => 'Please enter a currency for the tuition fee, for example USD.',
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
        $validated = $request->validate(
            $this->rules(),
            self::MESSAGES
        );

        DB::transaction(function () use ($request, $validated) {
            $course = Course::create($this->courseFields($request, $validated));

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
        $validated = $request->validate(
            $this->rules(),
            self::MESSAGES
        );

        DB::transaction(function () use ($request, $validated, $course) {
            $course->update($this->courseFields($request, $validated));

            $this->saveTuition($course, $validated);
        });

        return redirect()
            ->route('admin.courses.index')
            ->with(
                'success',
                'Course updated successfully.'
            );
    }

    public function destroy(Course $course)
    {
        $course->update([
            'is_active' => false
        ]);

        return redirect()
            ->route('admin.courses.index')
            ->with(
                'success',
                'Course deactivated successfully.'
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
            'duration' => [
                'nullable',
                'string',
                'max:100'
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
                'string',
                'max:10'
            ],
            'tuition_period' => [
                'nullable',
                'in:' . implode(',', self::FEE_PERIODS)
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
            'duration',
            'study_mode',
            'description',
        ])->all();

        $fields['is_active'] = $request->boolean('is_active');

        return $fields;
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