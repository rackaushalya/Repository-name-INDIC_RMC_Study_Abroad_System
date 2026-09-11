<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Consultant;
use App\Models\Student;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['student.user', 'consultant.user'])
            ->latest('appointment_date')
            ->paginate(20);

        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $students = Student::with('user')->get();
        $consultants = Consultant::with('user')->get();

        return view('admin.appointments.create', compact(
            'students',
            'consultants'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,student_id'],
            'consultant_id' => ['required', 'exists:consultants,consultant_id'],
            'application_id' => ['nullable', 'exists:applications,application_id'],
            'appointment_date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['required', 'after:start_time'],
            'appointment_type' => [
                'required',
                'in:Online,Physical,Phone'
            ],
            'meeting_link' => ['nullable', 'string', 'max:255'],
            'appointment_status' => [
                'nullable',
                'in:Requested,Confirmed,Completed,Cancelled,No Show'
            ],
            'student_notes' => ['nullable', 'string'],
            'consultant_notes' => ['nullable', 'string'],
        ]);

        Appointment::create([
            'student_id' => $validated['student_id'],
            'consultant_id' => $validated['consultant_id'],
            'application_id' => $validated['application_id'] ?? null,
            'appointment_date' => $validated['appointment_date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'appointment_type' => $validated['appointment_type'],
            'meeting_link' => $validated['meeting_link'] ?? null,
            'appointment_status' => $validated['appointment_status'] ?? 'Requested',
            'student_notes' => $validated['student_notes'] ?? null,
            'consultant_notes' => $validated['consultant_notes'] ?? null,
        ]);

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load([
            'student.user',
            'consultant.user',
            'application'
        ]);

        return view('admin.appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $students = Student::with('user')->get();
        $consultants = Consultant::with('user')->get();

        return view('admin.appointments.edit', compact(
            'appointment',
            'students',
            'consultants'
        ));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,student_id'],
            'consultant_id' => ['required', 'exists:consultants,consultant_id'],
            'application_id' => ['nullable', 'exists:applications,application_id'],
            'appointment_date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['required', 'after:start_time'],
            'appointment_type' => [
                'required',
                'in:Online,Physical,Phone'
            ],
            'meeting_link' => ['nullable', 'string', 'max:255'],
            'appointment_status' => [
                'required',
                'in:Requested,Confirmed,Completed,Cancelled,No Show'
            ],
            'student_notes' => ['nullable', 'string'],
            'consultant_notes' => ['nullable', 'string'],
        ]);

        $appointment->update($validated);

        return back()->with(
            'success',
            'Appointment updated successfully.'
        );
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->update([
            'appointment_status' => 'Cancelled'
        ]);

        return back()->with(
            'success',
            'Appointment cancelled successfully.'
        );
    }
}