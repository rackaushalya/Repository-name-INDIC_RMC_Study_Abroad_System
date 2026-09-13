<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index()
    {
        $universities = University::with('country')
            ->latest('university_id')
            ->paginate(20);

        return view(
            'admin.universities.index',
            compact('universities')
        );
    }

    public function create()
    {
        $countries = Country::where('is_active', true)
            ->orderBy('country_name')
            ->get();

        return view(
            'admin.universities.create',
            compact('countries')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
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
                'required',
                'string',
                'max:50',
                'unique:universities,university_code'
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
        ]);

        $validated['is_active'] =
            $request->boolean('is_active');

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
        $university->load([
            'country',
            'courses'
        ]);

        return view(
            'admin.universities.show',
            compact('university')
        );
    }

    public function edit(University $university)
    {
        $countries = Country::where('is_active', true)
            ->orderBy('country_name')
            ->get();

        return view(
            'admin.universities.edit',
            compact('university', 'countries')
        );
    }

    public function update(
        Request $request,
        University $university
    ) {
        $validated = $request->validate([
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
                'required',
                'string',
                'max:50',
                'unique:universities,university_code,' .
                $university->university_id .
                ',university_id'
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
        ]);

        $validated['is_active'] =
            $request->boolean('is_active');

        $university->update($validated);

        return redirect()
            ->route('admin.universities.index')
            ->with(
                'success',
                'University updated successfully.'
            );
    }

    public function destroy(University $university)
    {
        $university->update([
            'is_active' => false
        ]);

        return redirect()
            ->route('admin.universities.index')
            ->with(
                'success',
                'University deactivated successfully.'
            );
    }
}