<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('country_name')
            ->get();

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
        $validated = $request->validate(
            $this->rules()
        );

        $validated['country_code'] =
            strtoupper($validated['country_code']);

        $validated['is_active'] =
            $request->boolean('is_active', true);

        $country = Country::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Country created successfully.',
                'country' => $country->toAdminArray(),
            ], 201);
        }

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
        $validated = $request->validate(
            $this->rules($country)
        );

        $validated['country_code'] =
            strtoupper($validated['country_code']);

        $validated['is_active'] =
            $request->boolean('is_active');

        $country->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Country updated successfully.',
                'country' => $country->fresh()->toAdminArray(),
            ]);
        }

        return redirect()
            ->route('admin.countries.index')
            ->with(
                'success',
                'Country updated successfully.'
            );
    }

    public function destroy(Request $request, Country $country)
    {
        $country->update([
            'is_active' => false
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Country deactivated successfully.',
                'country' => $country->fresh()->toAdminArray(),
            ]);
        }

        return redirect()
            ->route('admin.countries.index')
            ->with(
                'success',
                'Country deactivated successfully.'
            );
    }

    private function rules(?Country $country = null): array
    {
        $ignore = $country
            ? ',' . $country->country_id . ',country_id'
            : '';

        return [
            'country_name' => [
                'required',
                'string',
                'max:100',
                'unique:countries,country_name' . $ignore
            ],
            'country_code' => [
                'required',
                'string',
                'max:10',
                'unique:countries,country_code' . $ignore
            ],
            'capital' => [
                'nullable',
                'string',
                'max:100'
            ],
            'key_cities' => [
                'nullable',
                'string',
                'max:255'
            ],
            'region' => [
                'nullable',
                'string',
                'max:50'
            ],
            'visa_processing_time' => [
                'nullable',
                'string',
                'max:100'
            ],
            'funds_required' => [
                'nullable',
                'string',
                'max:255'
            ],
            'visa_guidelines' => [
                'nullable',
                'string'
            ],
            'flag_image' => [
                'nullable',
                'string',
                'starts_with:data:image/',
                'max:2000000'
            ],
            'description' => [
                'nullable',
                'string'
            ],
            'is_active' => [
                'boolean'
            ],
        ];
    }
}
