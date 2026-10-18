<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Application;
use App\Models\ApplicationStatusHistory;
use App\Models\ConsultationRecord;
use App\Models\Notification;
use App\Services\AuditLogService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
        $cid = $consultant->consultant_id;
        $today = Carbon::today();

        $activeAssignments = ConsultantAssignment::where('consultant_id', $cid)
            ->where('assignment_status', 'Active');

        $stats = [
            'total_students' => (clone $activeAssignments)->distinct()->count('application_id'),
            'today_appointments' => Appointment::where('consultant_id', $cid)
                ->whereDate('appointment_date', $today)
                ->whereIn('appointment_status', ['Requested', 'Confirmed'])
                ->count(),
            'week_appointments' => Appointment::where('consultant_id', $cid)
                ->whereBetween('appointment_date', [$today->copy(), $today->copy()->addDays(6)])
                ->whereIn('appointment_status', ['Requested', 'Confirmed'])
                ->count(),
            'pending_requests' => Appointment::where('consultant_id', $cid)
                ->where('appointment_status', 'Requested')
                ->count(),
            'completed_consultations' => ConsultationRecord::where('consultant_id', $cid)->count(),
            'pending_records' => $this->appointmentsAwaitingRecord($cid)->count(),
            'pending_follow_ups' => FollowUp::where('consultant_id', $cid)
                ->where('follow_up_status', 'Pending')
                ->count(),
        ];

        $upcomingAppointments = Appointment::where('consultant_id', $cid)
            ->whereIn('appointment_status', ['Requested', 'Confirmed'])
            ->whereDate('appointment_date', '>=', $today)
            ->with(['student.user', 'application'])
            ->orderBy('appointment_date')
            ->orderBy('start_time')
            ->take(8)
            ->get();

        $recentStudents = ConsultantAssignment::where('consultant_id', $cid)
            ->where('assignment_status', 'Active')
            ->with(['application.student.user', 'application.preferredCountry'])
            ->latest('assigned_at')
            ->take(6)
            ->get();

        $recentRecords = ConsultationRecord::where('consultant_id', $cid)
            ->with(['student.user', 'appointment'])
            ->latest('created_at')
            ->take(5)
            ->get();

        $awaitingRecord = $this->appointmentsAwaitingRecord($cid)
            ->with(['student.user'])
            ->orderByDesc('appointment_date')
            ->take(5)
            ->get();

        return view('consultant.dashboard', compact(
            'consultant',
            'stats',
            'upcomingAppointments',
            'recentStudents',
            'recentRecords',
            'awaitingRecord'
        ));
    }

    /**
     * Appointments that are confirmed/completed, already started, and have no consultation record yet.
     */
    private function appointmentsAwaitingRecord(int $consultantId)
    {
        return Appointment::where('consultant_id', $consultantId)
            ->whereIn('appointment_status', ['Confirmed', 'Completed'])
            ->whereDate('appointment_date', '<=', Carbon::today())
            ->whereNotIn('appointment_id', function ($q) {
                $q->select('appointment_id')->from('consultation_records');
            });
    }

    /**
     * Display assigned students.
     */
    public function students(Request $request)
    {
        $consultant = $this->getConsultant();

        $query = ConsultantAssignment::where('consultant_id', $consultant->consultant_id)
            ->with([
                'application.student.user',
                'application.preferredCountry',
                'application.preferredCourse',
            ]);

        if ($status = $request->query('status')) {
            if (in_array($status, ['Active', 'Completed', 'Cancelled'], true)) {
                $query->where('assignment_status', $status);
            }
        }

        if ($stage = $request->query('stage')) {
            $query->whereHas('application', fn ($q) => $q->where('application_status', $stage));
        }

        if ($search = trim((string) $request->query('q'))) {
            $query->whereHas('application', function ($q) use ($search) {
                $q->where('application_reference', 'like', "%{$search}%")
                    ->orWhereHas('student.user', function ($u) use ($search) {
                        $u->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $assignments = $query->latest('assigned_at')->paginate(15)->withQueryString();

        $stages = [
            'Consultant Assigned', 'Consultation Scheduled', 'Consultation Completed',
            'Recommendation Provided', 'Follow-up Required', 'Completed',
        ];

        return view('consultant.students', compact('consultant', 'assignments', 'stages'));
    }

    /**
     * Single assigned student: profile, application, appointments, consultation history.
     */
    public function studentShow(ConsultantAssignment $assignment)
    {
        $consultant = $this->getConsultant();

        if ((int) $assignment->consultant_id !== (int) $consultant->consultant_id) {
            abort(403);
        }

        $assignment->load([
            'application.student.user',
            'application.preferredCountry',
            'application.preferredCourse',
            'application.preferredIntake',
            'application.statusHistory',
        ]);

        $application = $assignment->application;
        $student = $application->student;

        $appointments = Appointment::where('consultant_id', $consultant->consultant_id)
            ->where('student_id', $student->student_id)
            ->orderByDesc('appointment_date')
            ->orderByDesc('start_time')
            ->get();

        $records = ConsultationRecord::where('consultant_id', $consultant->consultant_id)
            ->where('student_id', $student->student_id)
            ->latest('created_at')
            ->get();

        return view('consultant.student-show', compact(
            'consultant', 'assignment', 'application', 'student', 'appointments', 'records'
        ));
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
    public function appointments(Request $request)
    {
        $consultant = $this->getConsultant();
        $today = Carbon::today();

        $query = Appointment::where('consultant_id', $consultant->consultant_id)
            ->with(['student.user', 'application']);

        $view = $request->query('view', 'upcoming');

        if ($view === 'upcoming') {
            $query->whereDate('appointment_date', '>=', $today)
                ->whereIn('appointment_status', ['Requested', 'Confirmed'])
                ->orderBy('appointment_date')->orderBy('start_time');
        } elseif ($view === 'past') {
            $query->where(function ($q) use ($today) {
                $q->whereDate('appointment_date', '<', $today)
                    ->orWhereIn('appointment_status', ['Completed', 'Cancelled', 'No Show']);
            })->orderByDesc('appointment_date')->orderByDesc('start_time');
        } else {
            $view = 'all';
            $query->orderByDesc('appointment_date')->orderByDesc('start_time');
        }

        if ($status = $request->query('status')) {
            if (in_array($status, ['Requested', 'Confirmed', 'Completed', 'Cancelled', 'No Show'], true)) {
                $query->where('appointment_status', $status);
            }
        }

        if ($search = trim((string) $request->query('q'))) {
            $query->whereHas('student.user', function ($u) use ($search) {
                $u->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        $appointments = $query->paginate(15)->withQueryString();

        $recordIds = ConsultationRecord::whereIn(
            'appointment_id',
            $appointments->pluck('appointment_id')
        )->pluck('consultation_record_id', 'appointment_id');

        return view('consultant.appointments', compact('consultant', 'appointments', 'view', 'recordIds'));
    }

    /**
     * Month calendar of the consultant's appointments.
     */
    public function calendar(Request $request)
    {
        $consultant = $this->getConsultant();

        try {
            $month = Carbon::createFromFormat('Y-m', (string) $request->query('month', now()->format('Y-m')))
                ->startOfMonth();
        } catch (\Throwable $e) {
            $month = now()->startOfMonth();
        }

        $gridStart = $month->copy()->startOfWeek(Carbon::MONDAY);
        $gridEnd = $month->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

        $appointments = Appointment::where('consultant_id', $consultant->consultant_id)
            ->whereBetween('appointment_date', [$gridStart->toDateString(), $gridEnd->toDateString()])
            ->with(['student.user'])
            ->orderBy('start_time')
            ->get()
            ->groupBy(fn ($a) => $a->appointment_date->toDateString());

        $weeks = [];
        $cursor = $gridStart->copy();
        while ($cursor <= $gridEnd) {
            $week = [];
            for ($i = 0; $i < 7; $i++) {
                $week[] = $cursor->copy();
                $cursor->addDay();
            }
            $weeks[] = $week;
        }

        try {
            $selected = $request->filled('date')
                ? Carbon::createFromFormat('Y-m-d', (string) $request->query('date'))->startOfDay()
                : Carbon::today();
        } catch (\Throwable $e) {
            $selected = Carbon::today();
        }

        $selectedAppointments = Appointment::where('consultant_id', $consultant->consultant_id)
            ->whereDate('appointment_date', $selected->toDateString())
            ->with(['student.user', 'application'])
            ->orderBy('start_time')
            ->get();

        $availability = ConsultantAvailability::where('consultant_id', $consultant->consultant_id)
            ->where('is_available', true)
            ->get()
            ->groupBy('day_of_week');

        return view('consultant.calendar', [
            'consultant' => $consultant,
            'month' => $month,
            'prevMonth' => $month->copy()->subMonth()->format('Y-m'),
            'nextMonth' => $month->copy()->addMonth()->format('Y-m'),
            'weeks' => $weeks,
            'appointments' => $appointments,
            'selected' => $selected,
            'selectedAppointments' => $selectedAppointments,
            'availability' => $availability,
        ]);
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

        if ((int) $appointment->consultant_id !== (int) $consultant->consultant_id) {
            abort(403);
        }

        $validated = $request->validate([
            'appointment_status' => ['required', 'in:Requested,Confirmed,Completed,Cancelled,No Show'],
            'consultant_notes' => ['nullable', 'string', 'max:5000'],
            'meeting_link' => ['nullable', 'string', 'max:500'],
        ]);

        $old = $appointment->appointment_status;

        DB::transaction(function () use ($appointment, $validated, $old) {
            $appointment->update(array_filter(
                $validated,
                fn ($v, $k) => $k === 'appointment_status' || $v !== null,
                ARRAY_FILTER_USE_BOTH
            ));

            // Confirming an appointment moves the linked application to "Consultation Scheduled".
            if (
                $validated['appointment_status'] === 'Confirmed'
                && $old !== 'Confirmed'
                && $appointment->application
                && in_array($appointment->application->application_status, ['Submitted', 'Under Review', 'Consultant Assigned'], true)
            ) {
                $this->moveApplication($appointment->application, 'Consultation Scheduled', 'Appointment confirmed by consultant.');
            }

            if ($old !== $validated['appointment_status']) {
                $this->notifyStudent(
                    $appointment,
                    'Appointment ' . strtolower($validated['appointment_status']),
                    'Your appointment on ' . $appointment->appointment_date->format('d M Y')
                    . ' at ' . Carbon::parse($appointment->start_time)->format('h:i A')
                    . ' is now ' . $validated['appointment_status'] . '.'
                );
            }
        });

        AuditLogService::log(
            'Consultant Updated Appointment Status',
            'appointments',
            (int) $appointment->appointment_id,
            ['appointment_status' => $old],
            ['appointment_status' => $validated['appointment_status']]
        );

        return back()->with('success', 'Appointment updated successfully.');
    }

    /* =====================================================================
     |  CONSULTATIONS
     ===================================================================== */

    public function consultations(Request $request)
    {
        $consultant = $this->getConsultant();
        $cid = $consultant->consultant_id;

        $query = ConsultationRecord::where('consultant_id', $cid)
            ->with(['student.user', 'appointment']);

        if ($status = $request->query('status')) {
            if (in_array($status, ['Completed', 'Follow-up Required', 'Closed'], true)) {
                $query->where('consultation_status', $status);
            }
        }

        if ($search = trim((string) $request->query('q'))) {
            $query->whereHas('student.user', function ($u) use ($search) {
                $u->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        $records = $query->latest('created_at')->paginate(12)->withQueryString();

        $awaiting = $this->appointmentsAwaitingRecord($cid)
            ->with(['student.user'])
            ->orderByDesc('appointment_date')
            ->get();

        return view('consultant.consultations', compact('consultant', 'records', 'awaiting'));
    }

    public function consultationCreate(Appointment $appointment)
    {
        $consultant = $this->getConsultant();
        $this->authorizeAppointment($appointment, $consultant);

        if ($existing = ConsultationRecord::where('appointment_id', $appointment->appointment_id)->first()) {
            return redirect()
                ->route('consultant.consultations.edit', $existing->consultation_record_id)
                ->with('success', 'A record already exists for this appointment — you can edit it here.');
        }

        if (!in_array($appointment->appointment_status, ['Confirmed', 'Completed'], true)) {
            return redirect()->route('consultant.appointments')
                ->with('error', 'Only confirmed or completed appointments can have a consultation record.');
        }

        $appointment->load(['student.user', 'application.preferredCountry', 'application.preferredCourse']);

        return view('consultant.consultation-form', [
            'consultant' => $consultant,
            'appointment' => $appointment,
            'record' => null,
        ]);
    }

    public function consultationStore(Request $request, Appointment $appointment)
    {
        $consultant = $this->getConsultant();
        $this->authorizeAppointment($appointment, $consultant);

        if (ConsultationRecord::where('appointment_id', $appointment->appointment_id)->exists()) {
            return redirect()->route('consultant.consultations')
                ->with('error', 'A consultation record already exists for that appointment.');
        }

        if (!in_array($appointment->appointment_status, ['Confirmed', 'Completed'], true)) {
            abort(422, 'Appointment is not eligible for a consultation record.');
        }

        $data = $this->validateRecord($request);

        $record = DB::transaction(function () use ($data, $appointment, $consultant) {
            $record = ConsultationRecord::create($data + [
                'appointment_id' => $appointment->appointment_id,
                'consultant_id' => $consultant->consultant_id,
                'student_id' => $appointment->student_id,
            ]);

            if ($appointment->appointment_status !== 'Completed') {
                $appointment->update(['appointment_status' => 'Completed']);
            }

            $this->syncApplicationAfterConsultation($appointment, $data['consultation_status']);

            $this->notifyStudent(
                $appointment,
                'Consultation completed',
                'Your consultation on ' . $appointment->appointment_date->format('d M Y')
                . ' has been completed. Your consultant has recorded the summary and next steps.'
            );

            return $record;
        });

        AuditLogService::log(
            'Consultation Record Created',
            'consultation_records',
            (int) $record->consultation_record_id,
            null,
            $data
        );

        return redirect()
            ->route('consultant.consultations.show', $record->consultation_record_id)
            ->with('success', 'Consultation record saved.');
    }

    public function consultationShow(ConsultationRecord $record)
    {
        $consultant = $this->getConsultant();
        $this->authorizeRecord($record, $consultant);

        $record->load(['student.user', 'appointment.application.preferredCountry', 'appointment.application.preferredCourse']);

        return view('consultant.consultation-show', compact('consultant', 'record'));
    }

    public function consultationEdit(ConsultationRecord $record)
    {
        $consultant = $this->getConsultant();
        $this->authorizeRecord($record, $consultant);

        $record->load(['student.user', 'appointment.application.preferredCountry', 'appointment.application.preferredCourse']);

        return view('consultant.consultation-form', [
            'consultant' => $consultant,
            'appointment' => $record->appointment,
            'record' => $record,
        ]);
    }

    public function consultationUpdate(Request $request, ConsultationRecord $record)
    {
        $consultant = $this->getConsultant();
        $this->authorizeRecord($record, $consultant);

        $data = $this->validateRecord($request);
        $old = $record->only(array_keys($data));

        DB::transaction(function () use ($record, $data) {
            $record->update($data);
            $appointment = $record->appointment;
            if ($appointment) {
                $this->syncApplicationAfterConsultation($appointment, $data['consultation_status']);
            }
        });

        AuditLogService::log(
            'Consultation Record Updated',
            'consultation_records',
            (int) $record->consultation_record_id,
            $old,
            $data
        );

        return redirect()
            ->route('consultant.consultations.show', $record->consultation_record_id)
            ->with('success', 'Consultation record updated.');
    }

    /* ---------------------------------------------------------------------
     |  helpers
     --------------------------------------------------------------------- */

    private function authorizeAppointment(Appointment $appointment, Consultant $consultant): void
    {
        if ((int) $appointment->consultant_id !== (int) $consultant->consultant_id) {
            abort(403);
        }
    }

    private function authorizeRecord(ConsultationRecord $record, Consultant $consultant): void
    {
        if ((int) $record->consultant_id !== (int) $consultant->consultant_id) {
            abort(403);
        }
    }

    private function validateRecord(Request $request): array
    {
        return $request->validate([
            'consultation_summary' => ['required', 'string', 'max:5000'],
            'consultation_notes' => ['nullable', 'string', 'max:10000'],
            'recommendations' => ['nullable', 'string', 'max:10000'],
            'next_action' => ['nullable', 'string', 'max:5000'],
            'consultation_status' => ['required', 'in:Completed,Follow-up Required,Closed'],
        ]);
    }

    /**
     * Keep the linked application's status in step with the consultation outcome.
     */
    private function syncApplicationAfterConsultation(Appointment $appointment, string $consultationStatus): void
    {
        $application = $appointment->application;

        if (!$application) {
            return;
        }

        $target = $consultationStatus === 'Follow-up Required'
            ? 'Follow-up Required'
            : 'Consultation Completed';

        // Never move a finished/cancelled application backwards.
        if (in_array($application->application_status, ['Completed', 'Rejected', 'Cancelled', 'Recommendation Provided'], true)) {
            return;
        }

        if ($application->application_status !== $target) {
            $this->moveApplication($application, $target, 'Updated from consultation record.');
        }
    }

    private function moveApplication(Application $application, string $newStatus, string $remarks): void
    {
        $oldStatus = $application->application_status;

        $application->update(['application_status' => $newStatus]);

        ApplicationStatusHistory::create([
            'application_id' => $application->application_id,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'changed_by' => Auth::id(),
            'remarks' => $remarks,
            'changed_at' => now(),
        ]);
    }

    private function notifyStudent(Appointment $appointment, string $title, string $message): void
    {
        $userId = $appointment->student?->user_id;

        if (!$userId) {
            return;
        }

        Notification::create([
            'user_id' => $userId,
            'title' => $title,
            'message' => $message,
            'notification_type' => 'Appointment',
            'related_application_id' => $appointment->application_id,
            'is_read' => false,
            'created_at' => now(),
        ]);
    }
}
