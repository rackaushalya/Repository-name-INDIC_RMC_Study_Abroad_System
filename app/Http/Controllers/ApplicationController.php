<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Country;
use App\Models\Course;
use App\Models\CourseIntake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Display student's applications.
     */
    public function index()
    {
        $user = Auth::user();

        $student = $user?->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        $applications = Application::with([
            'preferredCountry',
            'preferredCourse',
            'preferredIntake'
        ])
            ->where('student_id', $student->student_id)
            ->latest('submitted_at')
            ->paginate(10);

        return view(
            'student.applications.index',
            compact('applications')
        );
    }

    /**
     * Show application form.
     */
    public function create()
    {
        $countries = Country::where('is_active', true)
            ->orderBy('country_name')
            ->get();

        $courses = Course::where('is_active', true)
            ->with('university')
            ->orderBy('course_name')
            ->get();

        $intakes = CourseIntake::whereIn(
            'intake_status',
            ['Open', 'Upcoming']
        )
            ->orderBy('application_open_date')
            ->get();

        return view(
            'student.applications.create',
            compact(
                'countries',
                'courses',
                'intakes'
            )
        );
    }

    /**
     * Store a new consultancy application.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $student = $user?->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        $validated = $request->validate([
            'preferred_country_id' => [
                'nullable',
                'integer',
                'exists:countries,country_id'
            ],
            'preferred_course_id' => [
                'nullable',
                'integer',
                'exists:courses,course_id'
            ],
            'preferred_intake_id' => [
                'nullable',
                'integer',
                'exists:course_intakes,intake_id'
            ],
            'application_type' => [
                'required',
                'in:Consultation Request,Study Abroad Guidance,General Request'
            ],
            'student_message' => [
                'nullable',
                'string'
            ],
        ]);

        $validated['student_id'] = $student->student_id;
        $validated['application_reference'] =
            'INDIC-' . strtoupper(uniqid());
        $validated['application_status'] = 'Submitted';
        $validated['submitted_at'] = now();

        Application::create($validated);

        return redirect()
            ->route('student.applications.index')
            ->with(
                'success',
                'Application submitted successfully.'
            );
    }

    /**
     * Display a specific application.
     */
    public function show(Application $application)
    {
        $user = Auth::user();

        $student = $user?->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        if ($application->student_id !== $student->student_id) {
            abort(403);
        }

        $application->load([
            'preferredCountry',
            'preferredCourse',
            'preferredIntake'
        ]);

        return view(
            'student.applications.show',
            compact('application')
        );
    }

    /**
     * Show edit application form.
     */
    public function edit(Application $application)
    {
        $user = Auth::user();

        $student = $user?->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        if ($application->student_id !== $student->student_id) {
            abort(403);
        }

        if (
            !in_array(
                $application->application_status,
                ['Submitted', 'Under Review']
            )
        ) {
            abort(
                403,
                'This application cannot be edited.'
            );
        }

        $countries = Country::where('is_active', true)
            ->orderBy('country_name')
            ->get();

        $courses = Course::where('is_active', true)
            ->with('university')
            ->orderBy('course_name')
            ->get();

        $intakes = CourseIntake::whereIn(
            'intake_status',
            ['Open', 'Upcoming']
        )
            ->orderBy('application_open_date')
            ->get();

        return view(
            'student.applications.edit',
            compact(
                'application',
                'countries',
                'courses',
                'intakes'
            )
        );
    }

    /**
     * Update an application.
     */
    public function update(
        Request $request,
        Application $application
    ) {
        $user = Auth::user();

        $student = $user?->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        if ($application->student_id !== $student->student_id) {
            abort(403);
        }

        if (
            !in_array(
                $application->application_status,
                ['Submitted', 'Under Review']
            )
        ) {
            abort(
                403,
                'This application cannot be edited.'
            );
        }

        $validated = $request->validate([
            'preferred_country_id' => [
                'nullable',
                'integer',
                'exists:countries,country_id'
            ],
            'preferred_course_id' => [
                'nullable',
                'integer',
                'exists:courses,course_id'
            ],
            'preferred_intake_id' => [
                'nullable',
                'integer',
                'exists:course_intakes,intake_id'
            ],
            'application_type' => [
                'required',
                'in:Consultation Request,Study Abroad Guidance,General Request'
            ],
            'student_message' => [
                'nullable',
                'string'
            ],
        ]);

        $application->update($validated);

        return redirect()
            ->route(
                'student.applications.show',
                $application
            )
            ->with(
                'success',
                'Application updated successfully.'
            );
    }

    /**
     * Cancel an application.
     */
    public function destroy(Application $application)
    {
        $user = Auth::user();

        $student = $user?->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        if ($application->student_id !== $student->student_id) {
            abort(403);
        }

        if (
            !in_array(
                $application->application_status,
                ['Submitted', 'Under Review']
            )
        ) {
            abort(
                403,
                'This application cannot be cancelled.'
            );
        }

        $application->update([
            'application_status' => 'Cancelled'
        ]);

        return redirect()
            ->route('student.applications.index')
            ->with(
                'success',
                'Application cancelled successfully.'
            );
    }
}