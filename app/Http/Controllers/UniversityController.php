<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UniversityController extends Controller
{
    public function index()
    {
        $universities = University::with(['country', 'courses'])
            ->latest('university_id')
            ->get();

        $countries = Country::orderBy('country_name')
            ->get();

        return view(
            'admin.universities',
            compact('universities', 'countries')
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
        $validated = $request->validate(
            $this->rules()
        );

        $validated['is_active'] =
            $request->boolean('is_active', true);

        $university = University::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'University created successfully.',
                'university' => $this->freshPayload($university),
            ], 201);
        }

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
        $validated = $request->validate(
            $this->rules($university)
        );

        $validated['is_active'] =
            $request->boolean('is_active');

        $university->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'University updated successfully.',
                'university' => $this->freshPayload($university),
            ]);
        }

        return redirect()
            ->route('admin.universities.index')
            ->with(
                'success',
                'University updated successfully.'
            );
    }

    public function destroy(Request $request, University $university)
    {
        $university->update([
            'is_active' => false
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'University deactivated successfully.',
                'university' => $this->freshPayload($university),
            ]);
        }

        return redirect()
            ->route('admin.universities.index')
            ->with(
                'success',
                'University deactivated successfully.'
            );
    }

    private function freshPayload(University $university): array
    {
        return $university
            ->fresh(['country', 'courses'])
            ->toAdminArray();
    }

    private function rules(?University $university = null): array
    {
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
                Rule::unique('universities', 'university_code')
                    ->ignore($university?->university_id, 'university_id')
            ],
            'website' => [
                'nullable',
                'url',
                'max:255'
            ],
            'contact_email' => [
                'nullable',
                'email',
                'max:255'
            ],
            'category' => [
                'nullable',
                'string',
                'max:150'
            ],
            'logo_image' => [
                'nullable',
                'string',
                'starts_with:data:image/',
                'max:2000000'
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
        ];
    }
}
