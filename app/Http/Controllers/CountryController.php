<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
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

    public function destroy(Country $country)
    {
        $country->update([
            'is_active' => false
        ]);

        return redirect()
            ->route('admin.countries.index')
            ->with(
                'success',
                'Country deactivated successfully.'
            );
    }
}