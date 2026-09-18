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
                ->get()
            : collect();

        $recommendations = $student
            ? $student->recommendations()
                ->with('course.university')
                ->latest('created_at')
                ->get()
            : collect();

        $appointments = $student
            ? $student->appointments()
                ->with('consultant.user')
                ->latest('appointment_date')
                ->get()
            : collect();

        return view('student.dashboard', compact(
            'student',
            'applications',
            'recommendations',
            'appointments'
        ));
    }

    public function profile()
    {
        $user = User::find(Auth::id());
        $student = Student::find($user?->student?->student_id);

        return view('student.profile', compact('student'));
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
            'phone' => ['nullable', 'string', 'max:30'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:Male,Female,Other'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'passport_number' => ['nullable', 'string', 'max:100'],
            'current_address' => ['nullable', 'string'],
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
        $student = Student::find($user?->student?->student_id);

        $preferences = $student?->preferences;

        return view('student.preferences', compact(
            'student',
            'preferences'
        ));
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