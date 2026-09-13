<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
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
        ]);

        $validated['is_active'] =
            $request->boolean('is_active');

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
        ]);

        $validated['is_active'] =
            $request->boolean('is_active');

        $country->update($validated);

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