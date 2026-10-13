<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Services\ApplicationJourney;
use App\Services\DeadlineAlerts;
use Illuminate\Support\Facades\Auth;

class ApplicationJourneyController extends Controller
{
    /**
     * Status timeline, deadlines and outstanding requirements for one application.
     */
    public function show(Application $application, ApplicationJourney $journeys, DeadlineAlerts $alerts)
    {
        $student = Auth::user()?->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        // A student may only open their own applications.
        if ((int) $application->student_id !== (int) $student->student_id) {
            abort(403);
        }

        $alerts->sync($student);

        $journey = $journeys->forApplication($application, $student);

        return view('student.applications.journey', compact('journey'));
    }
}
