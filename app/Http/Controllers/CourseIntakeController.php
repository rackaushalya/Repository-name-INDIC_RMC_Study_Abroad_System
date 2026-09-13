<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseIntake;
use Illuminate\Http\Request;

class CourseIntakeController extends Controller
{
    public function index()
    {
        $intakes = CourseIntake::with('course')
            ->latest('intake_id')
            ->paginate(20);

        return view(
            'admin.intakes.index',
            compact('intakes')
        );
    }

    public function create()
    {
        $courses = Course::where('is_active', true)
            ->orderBy('course_name')
            ->get();

        return view(
            'admin.intakes.create',
            compact('courses')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => [
                'required',
                'exists:courses,course_id'
            ],
            'intake_name' => [
                'required',
                'string',
                'max:100'
            ],
            'intake_month' => [
                'required',
                'string',
                'max:50'
            ],
            'application_open_date' => [
                'nullable',
                'date'
            ],
            'application_close_date' => [
                'nullable',
                'date',
                'after_or_equal:application_open_date'
            ],
            'intake_status' => [
                'required',
                'in:Open,Closed,Upcoming'
            ],
        ]);

        CourseIntake::create($validated);

        return redirect()
            ->route('admin.intakes.index')
            ->with(
                'success',
                'Course intake created successfully.'
            );
    }

    public function show(CourseIntake $courseIntake)
    {
        $courseIntake->load('course');

        return view(
            'admin.intakes.show',
            compact('courseIntake')
        );
    }

    public function edit(CourseIntake $courseIntake)
    {
        $courses = Course::where('is_active', true)
            ->orderBy('course_name')
            ->get();

        return view(
            'admin.intakes.edit',
            compact('courseIntake', 'courses')
        );
    }

    public function update(
        Request $request,
        CourseIntake $courseIntake
    ) {
        $validated = $request->validate([
            'course_id' => [
                'required',
                'exists:courses,course_id'
            ],
            'intake_name' => [
                'required',
                'string',
                'max:100'
            ],
            'intake_month' => [
                'required',
                'string',
                'max:50'
            ],
            'application_open_date' => [
                'nullable',
                'date'
            ],
            'application_close_date' => [
                'nullable',
                'date',
                'after_or_equal:application_open_date'
            ],
            'intake_status' => [
                'required',
                'in:Open,Closed,Upcoming'
            ],
        ]);

        $courseIntake->update($validated);

        return redirect()
            ->route('admin.intakes.index')
            ->with(
                'success',
                'Course intake updated successfully.'
            );
    }

    public function destroy(CourseIntake $courseIntake)
    {
        $courseIntake->update([
            'intake_status' => 'Closed'
        ]);

        return redirect()
            ->route('admin.intakes.index')
            ->with(
                'success',
                'Course intake closed successfully.'
            );
    }
}