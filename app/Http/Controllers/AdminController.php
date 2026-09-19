<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Appointment;
use App\Models\Consultant;
use App\Models\Country;
use App\Models\Course;
use App\Models\Student;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_students' => Student::count(),
            'total_consultants' => Consultant::count(),
            'total_countries' => Country::where('is_active', true)->count(),
            'total_universities' => University::where('is_active', true)->count(),
            'total_courses' => Course::where('is_active', true)->count(),
            'total_applications' => Application::count(),
            'total_appointments' => Appointment::count(),
        ];

        $recentApplications = Application::with('student.user')
            ->latest('submitted_at')
            ->take(10)
            ->get();

        $upcomingAppointments = Appointment::with([
            'student.user',
            'consultant.user'
        ])
            ->whereIn('appointment_status', [
                'Requested',
                'Confirmed'
            ])
            ->orderBy('appointment_date')
            ->orderBy('start_time')
            ->take(10)
            ->get();

        return view(
            'admin.dashboard',
            compact(
                'stats',
                'recentApplications',
                'upcomingAppointments'
            )
        );
    }

    /**
     * Recent Applications
     */
    public function recentApplications()
    {
        $applications = Application::with([
            'student.user'
        ])
            ->latest('submitted_at')
            ->paginate(20);

        return view(
            'admin.applications.index',
            compact('applications')
        );
    }

    /**
     * Upcoming Appointments
     */
    public function upcomingAppointments()
    {
        $appointments = Appointment::with([
            'student.user',
            'consultant.user'
        ])
            ->whereIn('appointment_status', [
                'Requested',
                'Confirmed'
            ])
            ->orderBy('appointment_date')
            ->orderBy('start_time')
            ->paginate(20);

        return view(
            'admin.appointments.index',
            compact('appointments')
        );
    }

    /**
     * View Users
     */
    public function users()
    {
        $users = User::with('role')
            ->latest('user_id')
            ->paginate(20);

        return view(
            'admin.users.index',
            compact('users')
        );
    }

    /**
     * View Students
     */
    public function students()
    {
        $students = Student::with('user')
            ->latest('student_id')
            ->paginate(20);

        return view(
            'admin.students.index',
            compact('students')
        );
    }

    /**
     * View Consultants
     */
    public function consultants()
    {
        $consultants = Consultant::with('user')
            ->latest('consultant_id')
            ->paginate(20);

        return view(
            'admin.consultants',
            compact('consultants')
        );
    }

    /**
     * View Countries
     */
    public function countries()
    {
        $countries = Country::orderBy('country_name')
            ->paginate(20);

        return view(
            'admin.countries',
            compact('countries')
        );
    }

    /**
     * View Universities
     */
    public function universities()
    {
        $universities = University::with('country')
            ->orderBy('university_name')
            ->paginate(20);

        return view(
            'admin.universities',
            compact('universities')
        );
    }

    /**
     * View Courses
     */
    public function courses()
    {
        $courses = Course::with('university')
            ->orderBy('course_name')
            ->paginate(20);

        return view(
            'admin.courses',
            compact('courses')
        );
    }

    /**
     * View Applications
     */
    public function applications()
    {
        $applications = Application::with([
            'student.user',
            'preferredCountry',
            'preferredCourse',
            'preferredIntake'
        ])
            ->latest('submitted_at')
            ->paginate(20);

        return view(
            'admin.applications.index',
            compact('applications')
        );
    }

    /**
     * View Appointments
     */
    public function appointments()
    {
        $appointments = Appointment::with([
            'student.user',
            'consultant.user'
        ])
            ->latest('appointment_date')
            ->paginate(20);

        return view(
            'admin.appointments.index',
            compact('appointments')
        );
    }

    /**
     * Search Admin Records
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::with('role')
            ->where(function ($q) use ($query) {
                $q->where('first_name', 'like', "%{$query}%")
                    ->orWhere('last_name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('phone', 'like', "%{$query}%");
            })
            ->paginate(20);

        return view(
            'admin.search',
            compact(
                'users',
                'query'
            )
        );
    }

   public function superAdminDashboard()
    {
    return $this->dashboard();
    }
}