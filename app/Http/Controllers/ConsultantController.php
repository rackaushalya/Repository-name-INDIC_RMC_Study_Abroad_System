<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Consultant;
use App\Models\ConsultantAssignment;
use App\Models\ConsultantAvailability;
use App\Models\FollowUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultantController extends Controller
{
    /**
     * Get the currently logged-in consultant.
     */
    private function getConsultant()
    {
        $consultant = Consultant::where(
            'user_id',
            Auth::id()
        )->first();

        if (!$consultant) {
            abort(403, 'Consultant profile not found.');
        }

        return $consultant;
    }

    /**
     * Consultant Dashboard.
     */
    public function dashboard()
    {
        $consultant = $this->getConsultant();

        $totalStudents = ConsultantAssignment::where(
            'consultant_id',
            $consultant->consultant_id
        )
            ->distinct('application_id')
            ->count('application_id');

        $totalAppointments = Appointment::where(
            'consultant_id',
            $consultant->consultant_id
        )->count();

        $upcomingAppointments = Appointment::where(
            'consultant_id',
            $consultant->consultant_id
        )
            ->whereIn('appointment_status', [
                'Requested',
                'Confirmed'
            ])
            ->orderBy('appointment_date')
            ->orderBy('start_time')
            ->take(10)
            ->get();

        $pendingFollowUps = FollowUp::where(
            'consultant_id',
            $consultant->consultant_id
        )
            ->where('follow_up_status', 'Pending')
            ->count();

        $stats = [
            'total_students' => $totalStudents,
            'total_appointments' => $totalAppointments,
            'pending_follow_ups' => $pendingFollowUps,
        ];

        return view(
            'consultant.dashboard',
            compact(
                'consultant',
                'stats',
                'upcomingAppointments'
            )
        );
    }

    /**
     * Display assigned students.
     */
    public function students()
    {
        $consultant = $this->getConsultant();

        $assignments = ConsultantAssignment::where(
            'consultant_id',
            $consultant->consultant_id
        )
            ->with([
                'application.student.user'
            ])
            ->latest('assigned_at')
            ->paginate(20);

        return view(
            'consultant.students',
            compact(
                'consultant',
                'assignments'
            )
        );
    }

    /**
     * Display consultant availability.
     */
    public function availability()
    {
        $consultant = $this->getConsultant();

        $availability = ConsultantAvailability::where(
            'consultant_id',
            $consultant->consultant_id
        )
            ->orderBy('availability_id')
            ->get();

        return view(
            'consultant.availability',
            compact(
                'consultant',
                'availability'
            )
        );
    }

    /**
     * Display consultant appointments.
     */
    public function appointments()
    {
        $consultant = $this->getConsultant();

        $appointments = Appointment::where(
            'consultant_id',
            $consultant->consultant_id
        )
            ->with([
                'student.user',
                'application'
            ])
            ->orderBy('appointment_date')
            ->orderBy('start_time')
            ->paginate(20);

        return view(
            'consultant.appointments',
            compact(
                'consultant',
                'appointments'
            )
        );
    }

    /**
     * Display consultant follow-ups.
     */
    public function followUps()
    {
        $consultant = $this->getConsultant();

        $followUps = FollowUp::where(
            'consultant_id',
            $consultant->consultant_id
        )
            ->with([
                'application.student.user'
            ])
            ->orderBy('follow_up_date')
            ->paginate(20);

        return view(
            'consultant.follow-ups',
            compact(
                'consultant',
                'followUps'
            )
        );
    }

    /**
     * Consultant settings.
     */
    public function settings()
    {
        $consultant = $this->getConsultant();

        $consultant->load('user');

        return view(
            'consultant.settings',
            compact('consultant')
        );
    }

    /**
     * Store consultant availability.
     */
    public function storeAvailability(Request $request)
    {
        $consultant = $this->getConsultant();

        $validated = $request->validate([
            'day_of_week' => [
                'required',
                'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday'
            ],
            'start_time' => [
                'required',
                'date_format:H:i'
            ],
            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time'
            ],
            'is_available' => [
                'boolean'
            ],
        ]);

        $validated['consultant_id'] =
            $consultant->consultant_id;

        $validated['is_available'] =
            $request->boolean('is_available');

        ConsultantAvailability::create($validated);

        return back()->with(
            'success',
            'Availability added successfully.'
        );
    }

    /**
     * Update consultant availability.
     */
    public function updateAvailability(
        Request $request,
        ConsultantAvailability $availability
    ) {
        $consultant = $this->getConsultant();

        if (
            $availability->consultant_id !==
            $consultant->consultant_id
        ) {
            abort(403);
        }

        $validated = $request->validate([
            'day_of_week' => [
                'required',
                'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday'
            ],
            'start_time' => [
                'required',
                'date_format:H:i'
            ],
            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time'
            ],
            'is_available' => [
                'boolean'
            ],
        ]);

        $validated['is_available'] =
            $request->boolean('is_available');

        $availability->update($validated);

        return back()->with(
            'success',
            'Availability updated successfully.'
        );
    }

    /**
     * Delete consultant availability.
     */
    public function destroyAvailability(
        ConsultantAvailability $availability
    ) {
        $consultant = $this->getConsultant();

        if (
            $availability->consultant_id !==
            $consultant->consultant_id
        ) {
            abort(403);
        }

        $availability->delete();

        return back()->with(
            'success',
            'Availability removed successfully.'
        );
    }

    /**
     * Update appointment status.
     */
    public function updateAppointmentStatus(
        Request $request,
        Appointment $appointment
    ) {
        $consultant = $this->getConsultant();

        if (
            $appointment->consultant_id !==
            $consultant->consultant_id
        ) {
            abort(403);
        }

        $validated = $request->validate([
            'appointment_status' => [
                'required',
                'in:Requested,Confirmed,Completed,Cancelled,No Show'
            ],
            'consultant_notes' => [
                'nullable',
                'string'
            ],
        ]);

        $appointment->update($validated);

        return back()->with(
            'success',
            'Appointment updated successfully.'
        );
    }
}