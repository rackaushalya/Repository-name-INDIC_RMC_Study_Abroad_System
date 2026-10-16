<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Course;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UniversityController extends Controller
{
    /** Uploaded logo: optional picture, up to 2 MB. SVG is not allowed for safety. */
    private const LOGO_RULES = [
        'nullable',
        'image',
        'mimes:jpg,jpeg,png,webp,gif',
        'max:2048',
    ];

    private const MESSAGES = [
        'country_id.required' => 'Please choose a country.',
        'country_id.exists' => 'Please choose a country from the list.',
        'website.url' => 'The website must be a full address starting with http:// or https://.',
        'logo_image.image' => 'The university image must be an image file.',
        'logo_image.mimes' => 'The university image must be a JPG, PNG, WEBP or GIF image.',
        'logo_image.max' => 'The university image must not be larger than 2 MB.',
    ];

    public function index()
    {
        $universities = University::with(['country', 'courses'])
            ->withCount('scholarships')
            ->orderBy('university_name')
            ->paginate(20);

        return view(
            'admin.universities',
            compact('universities')
        );
    }

    public function create()
    {
        return redirect()->route('admin.universities.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->rules(),
            self::MESSAGES
        );

        $validated['is_active'] =
            $request->boolean('is_active');

        unset($validated['logo_image']);

        if ($request->hasFile('logo_image')) {
            $validated['logo_image'] = $request->file('logo_image')
                ->store('university-logos', 'public');
        }

        University::create($validated);

        return redirect()
            ->route('admin.universities.index')
            ->with(
                'success',
                'University created successfully.'
            );
    }

    public function show(University $university)
    {
        return redirect()->route('admin.universities.index');
    }

    public function edit(University $university)
    {
        return redirect()->route('admin.universities.index');
    }

    public function update(
        Request $request,
        University $university
    ) {
        $validated = $request->validate(
            $this->rules($university),
            self::MESSAGES
        );

        $validated['is_active'] =
            $request->boolean('is_active');

        unset($validated['logo_image']);

        $oldLogo = $university->logo_image;

        if ($request->hasFile('logo_image')) {
            // New logo uploaded: save it and replace the old one.
            $validated['logo_image'] = $request->file('logo_image')
                ->store('university-logos', 'public');
        } elseif ($request->boolean('remove_logo')) {
            $validated['logo_image'] = null;
        }

        $university->update($validated);

        if (
            $oldLogo &&
            array_key_exists('logo_image', $validated) &&
            $validated['logo_image'] !== $oldLogo
        ) {
            Storage::disk('public')->delete($oldLogo);
        }

        return redirect()
            ->route('admin.universities.index')
            ->with(
                'success',
                'University updated successfully.'
            );
    }

    /**
     * Delete a university permanently, together with its courses and the
     * scholarships tied to it. Refused when students already use its courses,
     * so their applications and recommendations are never damaged.
     * (To hide a university without deleting it, set its status to Inactive.)
     */
    public function destroy(University $university)
    {
        $name = $university->university_name;
        $courseIds = $university->courses()->pluck('course_id');

        if ($courseIds->isNotEmpty()) {
            $studentLinks =
                DB::table('applications')->whereIn('preferred_course_id', $courseIds)->count()
                + DB::table('recommendations')->whereIn('course_id', $courseIds)->count()
                + DB::table('fund_requirements')->whereIn('selected_course_id', $courseIds)->count();

            if ($studentLinks > 0) {
                return redirect()
                    ->route('admin.universities.index')
                    ->with(
                        'error',
                        '"' . $name . '" can\'t be deleted because students have applications, '
                        . 'recommendations or fund reports linked to its courses. '
                        . 'Set it to Inactive instead to hide it from the website.'
                    );
            }
        }

        // Remember uploaded pictures so the files can be removed after the delete.
        $files = Course::whereIn('course_id', $courseIds)
            ->whereNotNull('course_image')
            ->pluck('course_image')
            ->push($university->logo_image)
            ->filter()
            ->all();

        DB::transaction(function () use ($university) {
            // Scholarships for this university only make sense with it.
            $university->scholarships()->delete();

            // Deleting the courses also removes their fees, intakes and requirements.
            $university->courses()->delete();

            $university->delete();
        });

        if ($files) {
            Storage::disk('public')->delete($files);
        }

        return redirect()
            ->route('admin.universities.index')
            ->with(
                'success',
                'University "' . $name . '" deleted.'
            );
    }

    /**
     * Validation rules shared by add and edit.
     */
    private function rules(?University $university = null): array
    {
        $uniqueCode = 'unique:universities,university_code';

        if ($university) {
            $uniqueCode .= ',' . $university->university_id . ',university_id';
        }

        return [
            'country_id' => [
                'required',
                'exists:countries,country_id'
            ],
            'university_name' => [
                'required',
                'string',
                'max:255'
            ],
            'university_code' => [
                'nullable',
                'string',
                'max:50',
                $uniqueCode
            ],
            'website' => [
                'nullable',
                'url',
                'max:255'
            ],
            'city' => [
                'nullable',
                'string',
                'max:100'
            ],
            'address' => [
                'nullable',
                'string',
                'max:255'
            ],
            'ranking' => [
                'nullable',
                'integer',
                'min:1'
            ],
            'description' => [
                'nullable',
                'string'
            ],
            'is_active' => [
                'boolean'
            ],
            'logo_image' => self::LOGO_RULES,
        ];
    }
}