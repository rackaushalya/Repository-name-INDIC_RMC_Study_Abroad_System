<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Services\AdmissionRoadmap;
use App\Services\EligibilityMatcher;
use Illuminate\Support\Facades\Auth;

class AdmissionRoadmapController extends Controller
{
    private function student(): Student
    {
        $student = Auth::user()?->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        return $student;
    }

    /**
     * Pick a course to see its roadmap. Courses are ranked by how close the
     * student is to qualifying, using the same matcher as the dashboard.
     */
    public function index(EligibilityMatcher $matcher)
    {
        $student = $this->student();

        $matches = $matcher->topMatches($student, 50);

        return view('student.roadmap.index', compact('matches'));
    }

    /**
     * Readiness, requirement statuses and next steps for one course.
     * Everything is calculated from the signed-in student's own data.
     */
    public function show(Course $course, AdmissionRoadmap $roadmap)
    {
        $student = $this->student();

        abort_unless($course->is_active, 404);

        $plan = $roadmap->build($student, $course);

        return view('student.roadmap.show', compact('plan'));
    }
}
