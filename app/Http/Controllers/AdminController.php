<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationStatusHistory;
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
use Illuminate\Validation\Rule;

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
                'in:active,inactive'
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
                'in:active,inactive'
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
                'in:active,inactive'
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
            $validated['account_status'] === 'inactive'
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
     * Build the filtered students query shared by the index listing
     * and the CSV export, so both stay in sync.
     */
    private function filteredStudentsQuery(Request $request)
    {
        $query = Student::with('user')
            ->withCount('applications');

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('nationality', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%")
                    ->orWhere('passport_number', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('account_status')) {
            $status = $request->input('account_status');

            $query->whereHas('user', function ($uq) use ($status) {
                $uq->where('account_status', $status);
            });
        }

        if ($request->filled('country')) {
            $query->where('country', $request->input('country'));
        }

        return $query;
    }


    /**
     * View Students
     */
    public function students(Request $request)
    {
        $students = $this->filteredStudentsQuery($request)
            ->latest('student_id')
            ->paginate(20)
            ->withQueryString();

        $countries = Student::whereNotNull('country')
            ->where('country', '!=', '')
            ->distinct()
            ->orderBy('country')
            ->pluck('country');

        $countryOptions = Country::where('is_active', true)
            ->orderBy('country_name')
            ->get();

        $stats = [
            'total' => Student::count(),
            'active' => Student::whereHas('user', function ($uq) {
                $uq->where('account_status', 'active');
            })->count(),
            'inactive' => Student::whereHas('user', function ($uq) {
                $uq->where('account_status', 'inactive');
            })->count(),
            'new_this_month' => Student::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'total_applications' => Application::count(),
        ];

        return view(
            'admin.students.index',
            compact(
                'students',
                'countries',
                'countryOptions',
                'stats'
            )
        );
    }


    /**
     * Show a specific student's full profile.
     */
    public function showStudent(Student $student)
    {
        $student->load([
            'user',
            'academicQualifications',
            'englishQualifications',
            'workExperiences',
            'preferences.preferredCountry',
            'applications' => function ($query) {
                $query->with(['preferredCountry', 'preferredCourse'])
                    ->latest('submitted_at');
            },
            'documents',
            'appointments' => function ($query) {
                $query->with('consultant.user')
                    ->orderByDesc('appointment_date');
            },
        ]);

        return view(
            'admin.students.show',
            compact('student')
        );
    }


    /**
     * Activate / deactivate a student's account.
     */
    public function updateStudentStatus(
        Request $request,
        Student $student
    ) {
        $validated = $request->validate([
            'account_status' => [
                'required',
                'in:active,inactive'
            ],
        ]);

        $student->loadMissing('user');

        if (!$student->user) {
            abort(404);
        }

        $student->user->account_status =
            $validated['account_status'];

        $student->user->save();

        return redirect()
            ->route('admin.students')
            ->with(
                'success',
                'Student account status updated successfully.'
            );
    }


    /**
     * Show the form to create a new student.
     */
    public function createStudent()
    {
        $countries = Country::where('is_active', true)
            ->orderBy('country_name')
            ->get();

        return view(
            'admin.students.create',
            compact('countries')
        );
    }


    /**
     * Store a newly created student (creates the User + Student records).
     */
    public function storeStudent(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['nullable', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'digits:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'account_status' => ['required', 'in:active,inactive'],
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
            'country' => [
                'nullable',
                Rule::in(Country::pluck('country_name'))
            ],
        ]);

        $studentRole = Role::where('role_name', 'Student')->first();

        if (!$studentRole) {
            return back()
                ->withErrors(['email' => 'Student role is not configured.'])
                ->withInput();
        }

        $user = User::create([
            'role_id' => $studentRole->role_id,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'] ?? null,
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password_hash' => Hash::make($validated['password']),
            'account_status' => $validated['account_status'],
        ]);

        $student = Student::create([
            'user_id' => $user->user_id,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'nationality' => $validated['nationality'] ?? null,
            'passport_number' => $validated['passport_number'] ?? null,
            'current_address' => $validated['current_address'] ?? null,
            'city' => $validated['city'] ?? null,
            'country' => $validated['country'] ?? null,
        ]);

        return redirect()
            ->route('admin.students.show', $student)
            ->with('success', 'Student created successfully.');
    }


    /**
     * Show the form to edit an existing student.
     */
    public function editStudent(Student $student)
    {
        $student->load('user');

        $countries = Country::where('is_active', true)
            ->orderBy('country_name')
            ->get();

        return view(
            'admin.students.edit',
            compact('student', 'countries')
        );
    }


    /**
     * Update an existing student's account + profile details.
     */
    public function updateStudent(Request $request, Student $student)
    {
        $student->loadMissing('user');

        if (!$student->user) {
            abort(404);
        }

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['nullable', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $student->user->user_id . ',user_id'
            ],
            'phone' => ['nullable', 'digits:10'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'account_status' => ['required', 'in:active,inactive'],
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
            'country' => [
                'nullable',
                Rule::in(Country::pluck('country_name'))
            ],
        ]);

        $student->user->first_name = $validated['first_name'];
        $student->user->last_name = $validated['last_name'] ?? null;
        $student->user->email = $validated['email'];
        $student->user->phone = $validated['phone'] ?? null;
        $student->user->account_status = $validated['account_status'];

        if (!empty($validated['password'])) {
            $student->user->password_hash = Hash::make($validated['password']);
        }

        $student->user->save();

        $student->update([
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'nationality' => $validated['nationality'] ?? null,
            'passport_number' => $validated['passport_number'] ?? null,
            'current_address' => $validated['current_address'] ?? null,
            'city' => $validated['city'] ?? null,
            'country' => $validated['country'] ?? null,
        ]);

        return redirect()
            ->route('admin.students.show', $student)
            ->with('success', 'Student updated successfully.');
    }


    /**
     * Delete a student (and their underlying user account).
     */
    public function destroyStudent(Student $student)
    {
        $student->loadMissing('user');

        $applicationsCount = $student->applications()->count();

        if ($applicationsCount > 0) {
            return redirect()
                ->route('admin.students')
                ->with(
                    'error',
                    "Cannot delete this student: they have {$applicationsCount} "
                        . ($applicationsCount === 1 ? 'application' : 'applications')
                        . ' on file. Remove those applications first.'
                );
        }

        if ($student->user) {
            // Deleting the user cascades to the student row (and their
            // documents, qualifications, preferences, appointments, etc.).
            $student->user->delete();
        } else {
            $student->delete();
        }

        return redirect()
            ->route('admin.students')
            ->with('success', 'Student deleted successfully.');
    }


    /**
     * Export the (filtered) student list as a CSV download.
     */
    public function exportStudents(Request $request)
    {
        $students = $this->filteredStudentsQuery($request)
            ->latest('student_id')
            ->get();

        $filename = 'students-' . now()->format('Y-m-d-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $columns = [
            'Student ID',
            'First Name',
            'Last Name',
            'Email',
            'Phone',
            'Nationality',
            'Country',
            'Applications',
            'Status',
            'Joined',
        ];

        $callback = function () use ($students, $columns) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, $columns);

            foreach ($students as $student) {
                fputcsv($handle, [
                    'STU-' . str_pad($student->student_id, 4, '0', STR_PAD_LEFT),
                    $student->user->first_name ?? '',
                    $student->user->last_name ?? '',
                    $student->user->email ?? '',
                    $student->user->phone ?? '',
                    $student->nationality ?? '',
                    $student->country ?? '',
                    $student->applications_count,
                    ucfirst($student->user->account_status ?? ''),
                    optional($student->created_at)->format('Y-m-d'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
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
     * View a single application
     */
    public function applicationShow(Application $application)
    {
        $application->load([
            'student.user',
            'preferredCountry',
            'preferredCourse.university',
            'preferredIntake',
            'statusHistory.changedBy'
        ]);

        return view(
            'admin.applications.show',
            compact('application')
        );
    }


    /**
     * Update Application Status
     */
    public function updateApplicationStatus(
        Request $request,
        Application $application
    ) {
        $validated = $request->validate([
            'application_status' => [
                'required',
                'in:Submitted,Under Review,Approved,Rejected,Cancelled'
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:2000'
            ],
        ]);


        $oldStatus = $application->application_status;

        $newStatus = $validated['application_status'];


        /*
        |--------------------------------------------------------------------------
        | Prevent duplicate status history records
        |--------------------------------------------------------------------------
        */

        if ($oldStatus === $newStatus) {
            return redirect()
                ->route(
                    'admin.applications-show',
                    $application
                )
                ->with(
                    'error',
                    'The application is already in this status.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Update Application
        |--------------------------------------------------------------------------
        */

        $application->update([
            'application_status' => $newStatus,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Create Status History
        |--------------------------------------------------------------------------
        */

        ApplicationStatusHistory::create([
            'application_id' => $application->application_id,

            'old_status' => $oldStatus,

            'new_status' => $newStatus,

            'changed_by' => Auth::id(),

            'remarks' => $validated['remarks'] ?? null,

            'changed_at' => now(),
        ]);


        return redirect()
            ->route(
                'admin.applications-show',
                $application
            )
            ->with(
                'success',
                'Application status updated successfully.'
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