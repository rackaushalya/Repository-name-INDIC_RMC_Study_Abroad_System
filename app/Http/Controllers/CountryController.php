<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Course;
use App\Models\Scholarship;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    /** Uploaded flag: optional picture, up to 2 MB. SVG is not allowed for safety. */
    private const FLAG_RULES = [
        'nullable',
        'image',
        'mimes:jpg,jpeg,png,webp,gif',
        'max:2048',
    ];

    private const FLAG_MESSAGES = [
        'flag_image.image' => 'The flag must be an image.',
        'flag_image.mimes' => 'The flag must be a JPG, PNG, WEBP or GIF image.',
        'flag_image.max' => 'The flag image must not be larger than 2 MB.',
    ];

    public function index()
    {
        $countries = Country::orderBy('country_name')
            ->paginate(20);

        return view(
            'admin.countries',
            compact('countries')
        );
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'country_name' => [
                'required',
                'string',
                'max:255',
                'unique:countries,country_name'
            ],
            'country_code' => [
                'required',
                'string',
                'max:10',
                'unique:countries,country_code'
            ],
            'description' => [
                'nullable',
                'string'
            ],
            'is_active' => [
                'boolean'
            ],
            'flag_image' => self::FLAG_RULES,
        ], self::FLAG_MESSAGES);

        $validated['is_active'] =
            $request->boolean('is_active');

        unset($validated['flag_image']);

        if ($request->hasFile('flag_image')) {
            $validated['flag_image'] = $request->file('flag_image')
                ->store('flags', 'public');
        }

        Country::create($validated);

        return redirect()
            ->route('admin.countries.index')
            ->with(
                'success',
                'Country created successfully.'
            );
    }

    public function show(Country $country)
    {
        $country->load([
            'universities'
        ]);

        return view(
            'admin.countries.show',
            compact('country')
        );
    }

    public function edit(Country $country)
    {
        return view(
            'admin.countries.edit',
            compact('country')
        );
    }

    public function update(
        Request $request,
        Country $country
    ) {
        $validated = $request->validate([
            'country_name' => [
                'required',
                'string',
                'max:255',
                'unique:countries,country_name,' .
                $country->country_id .
                ',country_id'
            ],
            'country_code' => [
                'required',
                'string',
                'max:10',
                'unique:countries,country_code,' .
                $country->country_id .
                ',country_id'
            ],
            'description' => [
                'nullable',
                'string'
            ],
            'is_active' => [
                'boolean'
            ],
            'flag_image' => self::FLAG_RULES,
        ], self::FLAG_MESSAGES);

        $validated['is_active'] =
            $request->boolean('is_active');

        unset($validated['flag_image']);

        $oldFlag = $country->flag_image;

        if ($request->hasFile('flag_image')) {
            // New flag uploaded: save it and replace the old one.
            $validated['flag_image'] = $request->file('flag_image')
                ->store('flags', 'public');
        } elseif ($request->boolean('remove_flag')) {
            // "Use automatic flag" was chosen: forget the uploaded one.
            $validated['flag_image'] = null;
        }

        $country->update($validated);

        if (
            $oldFlag &&
            array_key_exists('flag_image', $validated) &&
            $validated['flag_image'] !== $oldFlag
        ) {
            Storage::disk('public')->delete($oldFlag);
        }

        return redirect()
            ->route('admin.countries.index')
            ->with(
                'success',
                'Country updated successfully.'
            );
    }

    /**
     * Delete a country permanently, together with its universities, their
     * courses and scholarships, and the country's document requirements.
     * Refused when any student record points at the country or its courses,
     * so student data is never damaged.
     * (To hide a country without deleting it, set its status to Inactive.)
     */
    public function destroy(Country $country)
    {
        $name = $country->country_name;
        $countryId = $country->country_id;
        $universityIds = $country->universities()->pluck('university_id');
        $courseIds = Course::whereIn('university_id', $universityIds)->pluck('course_id');

        $studentLinks =
            DB::table('applications')->where('preferred_country_id', $countryId)->count()
            + DB::table('student_preferences')->where('preferred_country_id', $countryId)->count()
            + DB::table('fund_requirements')->where('selected_country_id', $countryId)->count()
            + DB::table('leads')->where('interested_country_id', $countryId)->count();

        if ($courseIds->isNotEmpty()) {
            $studentLinks +=
                DB::table('applications')->whereIn('preferred_course_id', $courseIds)->count()
                + DB::table('recommendations')->whereIn('course_id', $courseIds)->count()
                + DB::table('fund_requirements')->whereIn('selected_course_id', $courseIds)->count();
        }

        if ($studentLinks > 0) {
            return redirect()
                ->route('admin.countries.index')
                ->with(
                    'error',
                    '"' . $name . '" can\'t be deleted because students or leads have chosen it, '
                    . 'or one of its courses, in their applications, preferences, recommendations or fund reports. '
                    . 'Set it to Inactive instead to hide it from the website.'
                );
        }

        // Remember uploaded pictures so the files can be removed after the delete.
        $files = collect([$country->flag_image])
            ->merge(University::whereIn('university_id', $universityIds)->pluck('logo_image'))
            ->merge(Course::whereIn('course_id', $courseIds)->pluck('course_image'))
            ->filter()
            ->all();

        DB::transaction(function () use ($country, $universityIds) {
            // Document requirements written for this country only.
            DB::table('required_documents')->where('country_id', $country->country_id)->delete();

            // Scholarships tied to this country's universities.
            Scholarship::whereIn('university_id', $universityIds)->delete();

            // Deleting the courses also removes their fees, intakes and requirements.
            Course::whereIn('university_id', $universityIds)->delete();

            University::whereIn('university_id', $universityIds)->delete();

            $country->delete();
        });

        if ($files) {
            Storage::disk('public')->delete($files);
        }

        return redirect()
            ->route('admin.countries.index')
            ->with(
                'success',
                'Country "' . $name . '" deleted.'
            );
    }
}