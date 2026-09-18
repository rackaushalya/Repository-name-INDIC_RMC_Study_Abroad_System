<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Appointment;
use App\Models\Consultant;
use App\Models\Country;
use App\Models\Course;
use App\Models\Role;
use App\Models\Student;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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


    /*
    |--------------------------------------------------------------------------
    | User Management
    |--------------------------------------------------------------------------
    */


    /**
     * Display all users.
     */
    public function users(Request $request)
    {
        $query = User::with('role');

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where(
                    'first_name',
                    'like',
                    "%{$search}%"
                )
                    ->orWhere(
                        'last_name',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'email',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'phone',
                        'like',
                        "%{$search}%"
                    );
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Filter by Role
        |--------------------------------------------------------------------------
        */

        if ($request->filled('role_id')) {
            $query->where(
                'role_id',
                $request->input('role_id')
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Filter by Account Status
        |--------------------------------------------------------------------------
        */

        if ($request->filled('account_status')) {
            $query->where(
                'account_status',
                $request->input('account_status')
            );
        }


        $users = $query
            ->latest('user_id')
            ->paginate(20)
            ->withQueryString();


        $roles = Role::orderBy('role_name')->get();


        return view(
            'admin.users',
            compact(
                'users',
                'roles'
            )
        );
    }


    /**
     * Show create user form.
     */
    public function createUser()
    {
        $roles = Role::orderBy('role_name')->get();

        return view(
            'admin.users.create',
            compact('roles')
        );
    }


    /**
     * Store a new user.
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'role_id' => [
                'required',
                'integer',
                'exists:roles,role_id'
            ],

            'first_name' => [
                'required',
                'string',
                'max:100'
            ],

            'last_name' => [
                'required',
                'string',
                'max:100'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email'
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30'
            ],

            'account_status' => [
                'required',
                'in:Active,Inactive'
            ],
        ]);


        User::create([
            'role_id' => $validated['role_id'],

            'first_name' => $validated['first_name'],

            'last_name' => $validated['last_name'],

            'email' => $validated['email'],

            'password_hash' => Hash::make(
                $validated['password']
            ),

            'phone' => $validated['phone'] ?? null,

            'account_status' => $validated['account_status'],
        ]);


        return redirect()
            ->route('admin.users')
            ->with(
                'success',
                'User created successfully.'
            );
    }


    /**
     * Show a specific user.
     */
    public function showUser(User $user)
    {
        $user->load('role');

        return view(
            'admin.users.show',
            compact('user')
        );
    }


    /**
     * Show edit user form.
     */
    public function editUser(User $user)
    {
        $roles = Role::orderBy('role_name')->get();

        return view(
            'admin.users.edit',
            compact(
                'user',
                'roles'
            )
        );
    }


    /**
     * Update an existing user.
     */
    public function updateUser(
        Request $request,
        User $user
    ) {
        $validated = $request->validate([
            'role_id' => [
                'required',
                'integer',
                'exists:roles,role_id'
            ],

            'first_name' => [
                'required',
                'string',
                'max:100'
            ],

            'last_name' => [
                'required',
                'string',
                'max:100'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->user_id . ',user_id'
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed'
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30'
            ],

            'account_status' => [
                'required',
                'in:Active,Inactive'
            ],
        ]);


        $user->role_id = $validated['role_id'];

        $user->first_name = $validated['first_name'];

        $user->last_name = $validated['last_name'];

        $user->email = $validated['email'];

        $user->phone = $validated['phone'] ?? null;

        $user->account_status = $validated['account_status'];


        /*
        |--------------------------------------------------------------------------
        | Only update password if admin entered a new password
        |--------------------------------------------------------------------------
        */

        if (!empty($validated['password'])) {
            $user->password_hash = Hash::make(
                $validated['password']
            );
        }


        $user->save();


        return redirect()
            ->route('admin.users')
            ->with(
                'success',
                'User updated successfully.'
            );
    }


    /**
     * Delete a user.
     */
    public function destroyUser(User $user)
    {
        /*
        |--------------------------------------------------------------------------
        | Prevent admin from deleting their own account
        |--------------------------------------------------------------------------
        */

        $currentUser = Auth::user();

        if (
            $currentUser &&
            $currentUser->user_id === $user->user_id
        ) {
            return redirect()
                ->route('admin.users')
                ->with(
                    'error',
                    'You cannot delete your own account.'
                );
        }


        $user->delete();


        return redirect()
            ->route('admin.users')
            ->with(
                'success',
                'User deleted successfully.'
            );
    }


    /**
     * Change user account status.
     */
    public function updateUserStatus(
        Request $request,
        User $user
    ) {
        $validated = $request->validate([
            'account_status' => [
                'required',
                'in:Active,Inactive'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Prevent admin from deactivating their own account
        |--------------------------------------------------------------------------
        */

        $currentUser = Auth::user();

        if (
            $currentUser &&
            $currentUser->user_id === $user->user_id &&
            $validated['account_status'] === 'Inactive'
        ) {
            return redirect()
                ->route('admin.users')
                ->with(
                    'error',
                    'You cannot deactivate your own account.'
                );
        }


        $user->account_status =
            $validated['account_status'];

        $user->save();


        return redirect()
            ->route('admin.users')
            ->with(
                'success',
                'Account status updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Existing Admin Functions
    |--------------------------------------------------------------------------
    */


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
            'admin.consultants.index',
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
                $q->where(
                    'first_name',
                    'like',
                    "%{$query}%"
                )
                    ->orWhere(
                        'last_name',
                        'like',
                        "%{$query}%"
                    )
                    ->orWhere(
                        'email',
                        'like',
                        "%{$query}%"
                    )
                    ->orWhere(
                        'phone',
                        'like',
                        "%{$query}%"
                    );
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


    /**
     * Super Admin Dashboard
     */
    public function superAdminDashboard()
    {
        return $this->dashboard();
    }
}