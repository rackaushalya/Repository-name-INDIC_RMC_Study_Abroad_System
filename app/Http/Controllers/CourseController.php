<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with([
            'university.country'
        ])
            ->latest('course_id')
            ->get();

        $universities = University::with('country')
            ->orderBy('university_name')
            ->get();

        return view(
            'admin.courses',
            compact('courses', 'universities')
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
        $validated = $request->validate(
            $this->rules()
        );

        $validated['is_active'] =
            $request->boolean('is_active', true);

        $course = Course::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Course created successfully.',
                'course' => $this->freshPayload($course),
            ], 201);
        }

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
        $validated = $request->validate(
            $this->rules($course)
        );

        $validated['is_active'] =
            $request->boolean('is_active');

        $course->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Course updated successfully.',
                'course' => $this->freshPayload($course),
            ]);
        }

        return redirect()
            ->route('admin.courses.index')
            ->with(
                'success',
                'Course updated successfully.'
            );
    }

    public function destroy(Request $request, Course $course)
    {
        $course->update([
            'is_active' => false
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Course deactivated successfully.',
                'course' => $this->freshPayload($course),
            ]);
        }

        return redirect()
            ->route('admin.courses.index')
            ->with(
                'success',
                'Course deactivated successfully.'
            );
    }

    private function freshPayload(Course $course): array
    {
        return $course
            ->fresh(['university.country'])
            ->toAdminArray();
    }

    private function rules(?Course $course = null): array
    {
        return [
            'university_id' => [
                'required',
                'exists:universities,university_id'
            ],
            'course_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('courses', 'course_code')
                    ->ignore($course?->course_id, 'course_id')
            ],
            'course_name' => [
                'required',
                'string',
                'max:255'
            ],
            'course_level' => [
                'required',
                'in:Certificate,Diploma,Bachelor,Master,MBA,PhD'
            ],
            'field_of_study' => [
                'nullable',
                'string',
                'max:150'
            ],
            'duration' => [
                'nullable',
                'string',
                'max:100'
            ],
            'tuition_fee' => [
                'nullable',
                'string',
                'max:100'
            ],
            'credits' => [
                'nullable',
                'string',
                'max:100'
            ],
            'intakes' => [
                'nullable',
                'string',
                'max:255'
            ],
            'min_gpa' => [
                'nullable',
                'string',
                'max:100'
            ],
            'english_requirement' => [
                'nullable',
                'string',
                'max:255'
            ],
            'prerequisites' => [
                'nullable',
                'string'
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
        ];
    }
}
