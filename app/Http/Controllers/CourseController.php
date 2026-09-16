<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\University;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with([
            'university.country'
        ])
            ->latest('course_id')
            ->paginate(20);

        return view(
            'admin.courses',
            compact('courses')
        );
    }

    public function create()
    {
        $universities = University::where('is_active', true)
            ->orderBy('university_name')
            ->get();

        return view(
            'admin.courses.create',
            compact('universities')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
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
                'in:Certificate,Diploma,Bachelor,Master,PhD'
            ],
            'field_of_study' => [
                'nullable',
                'string',
                'max:255'
            ],
            'duration' => [
                'nullable',
                'string',
                'max:100'
            ],
            'study_mode' => [
                'required',
                'in:On Campus,Online,Hybrid'
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

        Course::create($validated);

        return redirect()
            ->route('admin.courses.index')
            ->with(
                'success',
                'Course created successfully.'
            );
    }

    public function show(Course $course)
    {
        $course->load([
            'university.country',
            'intakes',
            'tuitionFees',
            'scholarships',
            'requirements',
            'englishRequirements'
        ]);

        return view(
            'admin.courses.show',
            compact('course')
        );
    }

    public function edit(Course $course)
    {
        $universities = University::where('is_active', true)
            ->orderBy('university_name')
            ->get();

        return view(
            'admin.courses.edit',
            compact('course', 'universities')
        );
    }

    public function update(
        Request $request,
        Course $course
    ) {
        $validated = $request->validate([
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
                'in:Certificate,Diploma,Bachelor,Master,PhD'
            ],
            'field_of_study' => [
                'nullable',
                'string',
                'max:255'
            ],
            'duration' => [
                'nullable',
                'string',
                'max:100'
            ],
            'study_mode' => [
                'required',
                'in:On Campus,Online,Hybrid'
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

        $course->update($validated);

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
}