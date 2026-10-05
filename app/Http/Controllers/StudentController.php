<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $user = User::find(Auth::id());
        $student = Student::with('user')->find($user?->student?->student_id);

        $applications = $student
            ? $student->applications()
                ->with([
                    'preferredCountry',
                    'preferredCourse',
                    'preferredIntake',
                    'statusHistory.changedBy'
                ])
                ->latest('submitted_at')
                ->get()
            : collect();

        $recommendations = $student
            ? $student->recommendations()
                ->with('course.university.country')
                ->latest('created_at')
                ->get()
            : collect();

        $appointments = $student
            ? $student->appointments()
                ->with('consultant.user')
                ->latest('appointment_date')
                ->get()
            : collect();

        $fundRequirement = $student
            ? $student->fundRequirements()
                ->latest('generated_at')
                ->first()
            : null;

        $notifications = $user
            ? $user->notifications()
                ->latest('created_at')
                ->take(4)
                ->get()
            : collect();

        $profileCompletion = $this->profileCompletion($student);

        $latestApplication = $applications->first();

        $applicationTimeline = $this->applicationTimeline($latestApplication);

        $completedSteps = collect($applicationTimeline)
            ->where('completed', true)
            ->count();

        $timelineProgressPercent = $completedSteps > 1
            ? (int) round((($completedSteps - 1) / (count($applicationTimeline) - 1)) * 100)
            : 0;

        $upcomingAppointments = $appointments
            ->whereIn('appointment_status', ['Requested', 'Confirmed'])
            ->filter(fn ($appointment) => $appointment->appointment_date
                && $appointment->appointment_date->isFuture())
            ->sortBy('appointment_date');

        $nextAppointment = $upcomingAppointments->first();

        $assignedConsultant = ($nextAppointment ?? $appointments->first())?->consultant;

        return view('student.dashboard', compact(
            'student',
            'applications',
            'recommendations',
            'appointments',
            'fundRequirement',
            'notifications',
            'profileCompletion',
            'latestApplication',
            'applicationTimeline',
            'timelineProgressPercent',
            'upcomingAppointments',
            'nextAppointment',
            'assignedConsultant'
        ));
    }

    /**
     * Reduce an application's real status (and status history) down to the
     * 5 milestone steps shown on the dashboard timeline: Submitted, Under
     * Review, Consultant Assigned, Consultation, and Completed.
     *
     * @return array<int, array{label: string, date: ?\Carbon\Carbon, completed: bool, current: bool}>
     */
    private function applicationTimeline($application): array
    {
        $steps = [
            1 => 'Submitted',
            2 => 'Under Review',
            3 => 'Consultant Assigned',
            4 => 'Consultation',
            5 => 'Completed',
        ];

        $statusToStep = [
            'Submitted' => 1,
            'Under Review' => 2,
            'Consultant Assigned' => 3,
            'Consultation Scheduled' => 4,
            'Consultation Completed' => 4,
            'Recommendation Provided' => 4,
            'Follow-up Required' => 4,
            'Completed' => 5,
            'Rejected' => 5,
            'Cancelled' => 5,
        ];

        if (!$application) {
            return collect($steps)->map(fn ($label) => [
                'label' => $label,
                'date' => null,
                'completed' => false,
                'current' => false,
            ])->all();
        }

        $isTerminalNegative = in_array(
            $application->application_status,
            ['Rejected', 'Cancelled'],
            true
        );

        $currentStep = $statusToStep[$application->application_status] ?? 1;

        $history = $application->statusHistory ?? collect();

        return collect($steps)->map(function ($label, $stepNumber) use (
            $application,
            $statusToStep,
            $history,
            $currentStep,
            $isTerminalNegative
        ) {
            $date = null;

            if ($stepNumber === 1) {
                $date = $application->submitted_at;
            } else {
                $matchingChange = $history
                    ->filter(fn ($entry) => ($statusToStep[$entry->new_status] ?? null) === $stepNumber)
                    ->sortByDesc('changed_at')
                    ->first();

                $date = $matchingChange?->changed_at;
            }

            return [
                'label' => $label,
                'date' => $date,
                'completed' => $stepNumber <= $currentStep,
                'current' => $stepNumber === $currentStep,
                'failed' => $stepNumber === $currentStep && $isTerminalNegative,
            ];
        })->all();
    }

    /**
     * Work out how complete the student's own profile is, across the
     * pieces of the app this controller/module owns: personal details,
     * qualifications, study preferences and uploaded documents.
     *
     * @return array{percentage: int, label: string}
     */
    private function profileCompletion(?Student $student): array
    {
        if (!$student) {
            return ['percentage' => 0, 'label' => 'Not started'];
        }

        $checks = [
            // Basic personal info on the user + student records.
            (bool) ($student->user?->first_name
                && $student->user?->phone
                && $student->date_of_birth
                && $student->gender
                && $student->nationality),

            // Passport & address details.
            (bool) ($student->passport_number
                && $student->current_address
                && $student->city
                && $student->country),

            // At least one academic and one English qualification on file.
            $student->academicQualifications()->exists()
                && $student->englishQualifications()->exists(),

            // Study preferences saved.
            (bool) $student->preferences,

            // At least one document uploaded.
            $student->documents()->exists(),
        ];

        $completed = count(array_filter($checks));
        $total = count($checks);
        $percentage = $total > 0 ? (int) round(($completed / $total) * 100) : 0;

        $label = match (true) {
            $percentage >= 100 => 'Profile complete',
            $percentage >= 80 => 'Almost complete',
            $percentage >= 50 => 'In progress',
            $percentage > 0 => 'Getting started',
            default => 'Not started',
        };

        return ['percentage' => $percentage, 'label' => $label];
    }

    public function profile()
    {
        $user = User::find(Auth::id());
        $student = Student::with('user')->find($user?->student?->student_id);

        return view('student.profile', compact('student', 'user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());

        if (!$user) {
            abort(403);
        }

        $student = Student::find($user->student?->student_id);

        if (!$student) {
            abort(403);
        }

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'digits:10'],
            'date_of_birth' => [
                'nullable',
                'date',
                'before_or_equal:' . now()->subYears(16)->format('Y-m-d')
            ],
            'gender' => ['nullable', 'in:Male,Female,Other'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'passport_number' => ['nullable', 'string', 'max:100'],
            'current_address' => ['nullable', 'string', 'max:500'],
            'city' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
        ]);

        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'] ?? null,
            'phone' => $validated['phone'] ?? null,
        ]);

        $student->update([
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'nationality' => $validated['nationality'] ?? null,
            'passport_number' => $validated['passport_number'] ?? null,
            'current_address' => $validated['current_address'] ?? null,
            'city' => $validated['city'] ?? null,
            'country' => $validated['country'] ?? null,
        ]);

        return back()->with(
            'success',
            'Profile updated successfully.'
        );
    }

    public function preferences()
    {
        $user = User::find(Auth::id());
        $student = Student::with('user')->find($user?->student?->student_id);

        $preferences = $student?->preferences;

        $countries = \App\Models\Country::where('is_active', true)
            ->orderBy('country_name')
            ->get();

        return view('student.preferences', compact(
            'student',
            'preferences',
            'countries'
        ));
    }

    public function updatePreferences(Request $request)
    {
        $user = User::find(Auth::id());

        if (!$user) {
            abort(403);
        }

        $student = Student::find($user->student?->student_id);

        if (!$student) {
            abort(403);
        }

        $validated = $request->validate([
            'preferred_country_id' => ['nullable', 'exists:countries,country_id'],
            'preferred_course_field' => ['nullable', 'string', 'max:255'],
            'preferred_course_level' => ['nullable', 'in:Certificate,Diploma,Bachelor,Master,PhD'],
            'preferred_intake' => ['nullable', 'string', 'max:100'],
            'min_budget' => ['nullable', 'numeric', 'min:0'],
            'max_budget' => ['nullable', 'numeric', 'min:0', 'gte:min_budget'],
            'preferred_study_mode' => ['nullable', 'in:On Campus,Online,Hybrid'],
            'preferred_duration' => ['nullable', 'string', 'max:100'],
        ]);

        $student->preferences()->updateOrCreate(
            ['student_id' => $student->student_id],
            $validated
        );

        return back()->with(
            'success',
            'Study preferences saved successfully.'
        );
    }

    public function applications()
    {
        $user = User::find(Auth::id());
        $student = Student::find($user?->student?->student_id);

        $applications = $student
            ? $student->applications()
                ->with([
                    'preferredCountry',
                    'preferredCourse',
                    'preferredIntake',
                    'statusHistory.changedBy'
                ])
                ->latest('submitted_at')
                ->paginate(10)
            : collect();

        return view('student.applications', compact(
            'applications'
        ));
    }

    public function recommendations()
    {
        $user = User::find(Auth::id());
        $student = Student::find($user?->student?->student_id);

        $recommendations = $student
            ? $student->recommendations()
                ->with('course.university')
                ->orderByDesc('match_percentage')
                ->paginate(10)
            : collect();

        return view('student.recommendations', compact(
            'recommendations'
        ));
    }

    public function appointments()
    {
        $user = User::find(Auth::id());
        $student = Student::find($user?->student?->student_id);

        $appointments = $student
            ? $student->appointments()
                ->with('consultant.user')
                ->orderByDesc('appointment_date')
                ->paginate(10)
            : collect();

        return view('student.appointments', compact(
            'appointments'
        ));
    }
}
