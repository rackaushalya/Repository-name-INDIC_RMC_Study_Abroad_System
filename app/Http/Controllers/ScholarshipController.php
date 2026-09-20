<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Scholarship;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ScholarshipController extends Controller
{
    /**
     * Display all scholarships.
     */
    public function index()
    {
        $scholarships = Scholarship::with([
            'university.country',
            'course'
        ])
            ->latest('scholarship_id')
            ->get();

        $universities = University::with('country')
            ->orderBy('university_name')
            ->get();

        return view(
            'admin.scholarships',
            compact('scholarships', 'universities')
        );
    }

    /**
     * Show create scholarship form.
     */
    public function create()
    {
        $universities = University::where('is_active', true)
            ->orderBy('university_name')
            ->get();

        $courses = Course::where('is_active', true)
            ->orderBy('course_name')
            ->get();

        return view(
            'admin.scholarships.create',
            compact(
                'universities',
                'courses'
            )
        );
    }

    /**
     * Store a new scholarship.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->rules()
        );

        $validated['is_active'] =
            $request->boolean('is_active', true);

        $scholarship = Scholarship::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Scholarship created successfully.',
                'scholarship' => $this->freshPayload($scholarship),
            ], 201);
        }

        return redirect()
            ->route('admin.scholarships.index')
            ->with(
                'success',
                'Scholarship created successfully.'
            );
    }

    /**
     * Display a scholarship.
     */
    public function show(Scholarship $scholarship)
    {
        $scholarship->load([
            'university',
            'course'
        ]);

        return view(
            'admin.scholarships.show',
            compact('scholarship')
        );
    }

    /**
     * Show edit scholarship form.
     */
    public function edit(Scholarship $scholarship)
    {
        $universities = University::where('is_active', true)
            ->orderBy('university_name')
            ->get();

        $courses = Course::where('is_active', true)
            ->orderBy('course_name')
            ->get();

        return view(
            'admin.scholarships.edit',
            compact(
                'scholarship',
                'universities',
                'courses'
            )
        );
    }

    /**
     * Update a scholarship.
     */
    public function update(
        Request $request,
        Scholarship $scholarship
    ) {
        $validated = $request->validate(
            $this->rules($scholarship)
        );

        $validated['is_active'] =
            $request->boolean('is_active');

        $scholarship->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Scholarship updated successfully.',
                'scholarship' => $this->freshPayload($scholarship),
            ]);
        }

        return redirect()
            ->route('admin.scholarships.index')
            ->with(
                'success',
                'Scholarship updated successfully.'
            );
    }

    /**
     * Deactivate a scholarship.
     */
    public function destroy(Request $request, Scholarship $scholarship)
    {
        $scholarship->update([
            'is_active' => false
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Scholarship deactivated successfully.',
                'scholarship' => $this->freshPayload($scholarship),
            ]);
        }

        return redirect()
            ->route('admin.scholarships.index')
            ->with(
                'success',
                'Scholarship deactivated successfully.'
            );
    }

    private function freshPayload(Scholarship $scholarship): array
    {
        return $scholarship
            ->fresh(['university.country'])
            ->toAdminArray();
    }

    private function rules(?Scholarship $scholarship = null): array
    {
        return [
            'university_id' => [
                'nullable',
                'integer',
                'exists:universities,university_id'
            ],
            'course_id' => [
                'nullable',
                'integer',
                'exists:courses,course_id'
            ],
            'scholarship_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('scholarships', 'scholarship_code')
                    ->ignore($scholarship?->scholarship_id, 'scholarship_id')
            ],
            'scholarship_name' => [
                'required',
                'string',
                'max:255'
            ],
            'coverage_type' => [
                'required',
                'in:Full,Partial,Grant,Stipend'
            ],
            'award_value' => [
                'required',
                'string',
                'max:255'
            ],
            'degree_level' => [
                'required',
                'in:Undergraduate,Postgraduate,PhD,All Levels'
            ],
            'field_of_study' => [
                'nullable',
                'string',
                'max:150'
            ],
            'min_gpa' => [
                'nullable',
                'string',
                'max:100'
            ],
            'quota' => [
                'nullable',
                'string',
                'max:150'
            ],
            'category' => [
                'nullable',
                'string',
                'max:100'
            ],
            'description' => [
                'nullable',
                'string'
            ],
            'amount' => [
                'nullable',
                'numeric',
                'min:0'
            ],
            'percentage' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100'
            ],
            'eligibility' => [
                'nullable',
                'string'
            ],
            'application_deadline' => [
                'nullable',
                'date'
            ],
            'is_active' => [
                'boolean'
            ],
        ];
    }
}
