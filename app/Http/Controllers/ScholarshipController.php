<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Scholarship;
use App\Models\University;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    /**
     * Display all scholarships.
     */
    public function index()
    {
        $scholarships = Scholarship::with([
            'university',
            'course'
        ])
            ->latest('scholarship_id')
            ->paginate(20);

        return view(
            'admin.scholarships',
            compact('scholarships')
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
        $validated = $request->validate([
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
            'scholarship_name' => [
                'required',
                'string',
                'max:255'
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
        ]);

        $validated['is_active'] =
            $request->boolean('is_active');

        Scholarship::create($validated);

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
        $validated = $request->validate([
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
            'scholarship_name' => [
                'required',
                'string',
                'max:255'
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
        ]);

        $validated['is_active'] =
            $request->boolean('is_active');

        $scholarship->update($validated);

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
    public function destroy(Scholarship $scholarship)
    {
        $scholarship->update([
            'is_active' => false
        ]);

        return redirect()
            ->route('admin.scholarships.index')
            ->with(
                'success',
                'Scholarship deactivated successfully.'
            );
    }
}