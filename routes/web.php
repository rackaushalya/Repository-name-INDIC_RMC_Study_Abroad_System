<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ConsultantController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseIntakeController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\TuitionFeeController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\FundRequirementController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ReportController;


/*
|--------------------------------------------------------------------------
| Public Website
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/about', [HomeController::class, 'about'])
    ->name('about');

Route::get('/how-it-works', [HomeController::class, 'howItWorks'])
    ->name('how.it.works');

Route::get('/countries', [HomeController::class, 'countries'])
    ->name('countries');

Route::get('/universities', [HomeController::class, 'universities'])
    ->name('universities');

Route::get('/courses', [HomeController::class, 'courses'])
    ->name('courses');

Route::get('/scholarships', [HomeController::class, 'scholarships'])
    ->name('scholarships');

Route::get('/contact', [HomeController::class, 'contact'])
    ->name('contact');


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Password Reset
|--------------------------------------------------------------------------
*/

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])
    ->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
    ->name('password.email');

Route::get('/reset-password', [AuthController::class, 'showResetPassword'])
    ->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.update');


/*
|--------------------------------------------------------------------------
| Generic Dashboard Redirect
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $user = Auth::user();

    if ($user->role->role_name === 'Admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role->role_name === 'Consultant') {
        return redirect()->route('consultant.dashboard');
    }

    if ($user->role->role_name === 'Student') {
        return redirect()->route('student.dashboard');
    }

    abort(403);

})->middleware('auth')->name('dashboard');


/*
|--------------------------------------------------------------------------
| Google Authentication
|--------------------------------------------------------------------------
*/

Route::get('/auth/google', [GoogleController::class, 'redirect'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleController::class, 'callback'])
    ->name('google.callback');


/*
|--------------------------------------------------------------------------
| Student Portal
|--------------------------------------------------------------------------
|
| Only authenticated Students can access these routes.
|
*/

Route::middleware(['auth', 'role:Student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Student Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [StudentController::class, 'dashboard'])
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Student Profile
        |--------------------------------------------------------------------------
        */

        Route::get('/profile', [StudentController::class, 'profile'])
            ->name('profile');

        Route::put('/profile', [StudentController::class, 'updateProfile'])
            ->name('profile.update');


        /*
        |--------------------------------------------------------------------------
        | Student Preferences
        |--------------------------------------------------------------------------
        */

        Route::get('/preferences', [StudentController::class, 'preferences'])
            ->name('preferences');


        /*
        |--------------------------------------------------------------------------
        | Student Applications
        |--------------------------------------------------------------------------
        */

        Route::get('/applications', [StudentController::class, 'applications'])
            ->name('applications');


        /*
        |--------------------------------------------------------------------------
        | Student Recommendations
        |--------------------------------------------------------------------------
        */

        Route::get('/recommendations', [StudentController::class, 'recommendations'])
            ->name('recommendations');


        /*
        |--------------------------------------------------------------------------
        | Student Appointments
        |--------------------------------------------------------------------------
        */

        Route::get('/appointments', [StudentController::class, 'appointments'])
            ->name('appointments');


        /*
        |--------------------------------------------------------------------------
        | Qualifications
        |--------------------------------------------------------------------------
        */

        Route::get('/qualifications', [QualificationController::class, 'index'])
            ->name('qualifications');


        /*
        |--------------------------------------------------------------------------
        | Academic Qualifications
        |--------------------------------------------------------------------------
        */

        Route::post('/qualifications/academic', [
            QualificationController::class,
            'storeAcademic'
        ])->name('qualifications.academic.store');

        Route::put('/qualifications/academic/{qualification}', [
            QualificationController::class,
            'updateAcademic'
        ])->name('qualifications.academic.update');

        Route::delete('/qualifications/academic/{qualification}', [
            QualificationController::class,
            'deleteAcademic'
        ])->name('qualifications.academic.delete');


        /*
        |--------------------------------------------------------------------------
        | English Qualifications
        |--------------------------------------------------------------------------
        */

        Route::post('/qualifications/english', [
            QualificationController::class,
            'storeEnglish'
        ])->name('qualifications.english.store');

        Route::put('/qualifications/english/{qualification}', [
            QualificationController::class,
            'updateEnglish'
        ])->name('qualifications.english.update');

        Route::delete('/qualifications/english/{qualification}', [
            QualificationController::class,
            'deleteEnglish'
        ])->name('qualifications.english.delete');


        /*
        |--------------------------------------------------------------------------
        | Work Experience
        |--------------------------------------------------------------------------
        */

        Route::post('/qualifications/work-experience', [
            QualificationController::class,
            'storeWorkExperience'
        ])->name('qualifications.work.store');

        Route::put('/qualifications/work-experience/{workExperience}', [
            QualificationController::class,
            'updateWorkExperience'
        ])->name('qualifications.work.update');

        Route::delete('/qualifications/work-experience/{workExperience}', [
            QualificationController::class,
            'deleteWorkExperience'
        ])->name('qualifications.work.delete');


        /*
        |--------------------------------------------------------------------------
        | Student Applications
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'applications',
            ApplicationController::class
        )->except(['destroy']);

        Route::delete(
            '/applications/{application}',
            [ApplicationController::class, 'destroy']
        )->name('applications.destroy');


        /*
        |--------------------------------------------------------------------------
        | Student Recommendations
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/recommendations',
            [RecommendationController::class, 'index']
        )->name('recommendations.index');

        Route::get(
            '/recommendations/{recommendation}',
            [RecommendationController::class, 'show']
        )->name('recommendations.show');

        Route::post(
            '/recommendations/generate',
            [RecommendationController::class, 'generate']
        )->name('recommendations.generate');


        /*
        |--------------------------------------------------------------------------
        | Fund Requirements
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'fund-requirements',
            FundRequirementController::class
        )->only([
            'index',
            'create',
            'store',
            'show',
            'destroy'
        ]);

    });


/*
|--------------------------------------------------------------------------
| Consultant Portal
|--------------------------------------------------------------------------
|
| Only authenticated Consultants can access these routes.
|
*/

Route::middleware(['auth', 'role:Consultant'])
    ->prefix('consultant')
    ->name('consultant.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Consultant Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [ConsultantController::class, 'dashboard']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Assigned Students
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/students',
            [ConsultantController::class, 'students']
        )->name('students');


        /*
        |--------------------------------------------------------------------------
        | Availability
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/availability',
            [ConsultantController::class, 'availability']
        )->name('availability');


        /*
        |--------------------------------------------------------------------------
        | Appointments
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/appointments',
            [ConsultantController::class, 'appointments']
        )->name('appointments');


        /*
        |--------------------------------------------------------------------------
        | Follow Ups
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/follow-ups',
            [ConsultantController::class, 'followUps']
        )->name('follow-ups');


        /*
        |--------------------------------------------------------------------------
        | Settings
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/settings',
            [ConsultantController::class, 'settings']
        )->name('settings');

    });


/*
|--------------------------------------------------------------------------
| Admin Portal
|--------------------------------------------------------------------------
|
| Only authenticated Admins can access these routes.
|
*/

Route::middleware(['auth', 'role:Admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Admin Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [AdminController::class, 'dashboard']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Recent Applications
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/recent-applications',
            [AdminController::class, 'recentApplications']
        )->name('recent-applications');


        /*
        |--------------------------------------------------------------------------
        | Upcoming Appointments
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/upcoming-appointments',
            [AdminController::class, 'upcomingAppointments']
        )->name('upcoming-appointments');


        /*
        |--------------------------------------------------------------------------
        | USER MANAGEMENT
        |--------------------------------------------------------------------------
        |
        | These routes connect the User Management Blade pages
        | with the AdminController.
        |
        */

        // View all users
        Route::get(
            '/users',
            [AdminController::class, 'users']
        )->name('users');


        // Show Add New User page
        Route::get(
            '/users/create',
            [AdminController::class, 'createUser']
        )->name('users.create');


        // Store new user
        Route::post(
            '/users',
            [AdminController::class, 'storeUser']
        )->name('users.store');


        // Show individual user
        Route::get(
            '/users/{user}',
            [AdminController::class, 'showUser']
        )->name('users.show');


        // Show Edit User page
        Route::get(
            '/users/{user}/edit',
            [AdminController::class, 'editUser']
        )->name('users.edit');


        // Update user
        Route::put(
            '/users/{user}',
            [AdminController::class, 'updateUser']
        )->name('users.update');


        // Delete user
        Route::delete(
            '/users/{user}',
            [AdminController::class, 'destroyUser']
        )->name('users.destroy');


        // Change user account status
        Route::patch(
            '/users/{user}/status',
            [AdminController::class, 'updateUserStatus']
        )->name('users.status');


        /*
        |--------------------------------------------------------------------------
        | Students
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/students',
            [AdminController::class, 'students']
        )->name('students');


        /*
        |--------------------------------------------------------------------------
        | Consultants
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/consultants',
            [AdminController::class, 'consultants']
        )->name('consultants');


        /*
        |--------------------------------------------------------------------------
        | Countries List
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/countries-list',
            [AdminController::class, 'countries']
        )->name('countries-list');


        /*
        |--------------------------------------------------------------------------
        | Universities List
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/universities-list',
            [AdminController::class, 'universities']
        )->name('universities-list');


        /*
        |--------------------------------------------------------------------------
        | Courses List
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/courses-list',
            [AdminController::class, 'courses']
        )->name('courses-list');


        /*
        |--------------------------------------------------------------------------
        | Applications List
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/applications-list',
            [AdminController::class, 'applications']
        )->name('applications-list');


        /*
        |--------------------------------------------------------------------------
        | Application Details
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/applications-list/{application}',
            [AdminController::class, 'applicationShow']
        )->name('applications-show');


        /*
        |--------------------------------------------------------------------------
        | Update Application Status
        |--------------------------------------------------------------------------
        */

        Route::patch(
            '/applications-list/{application}/status',
            [AdminController::class, 'updateApplicationStatus']
        )->name('applications-status');


        /*
        |--------------------------------------------------------------------------
        | Appointments List
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/appointments-list',
            [AdminController::class, 'appointments']
        )->name('appointments-list');


        /*
        |--------------------------------------------------------------------------
        | Admin Search
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/search',
            [AdminController::class, 'search']
        )->name('search');


        /*
        |--------------------------------------------------------------------------
        | University Management
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'universities',
            UniversityController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Country Management
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'countries',
            CountryController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Course Management
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'courses',
            CourseController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Course Intake Management
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'course-intakes',
            CourseIntakeController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Scholarship Management
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'scholarships',
            ScholarshipController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Tuition Fee Management
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'tuition-fees',
            TuitionFeeController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Appointment Management
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'appointments',
            AppointmentController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Lead Management / CRM
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'leads',
            LeadController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Inquiry Management / CRM
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'inquiries',
            InquiryController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Reports
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'reports',
            ReportController::class
        )->only([
            'index',
            'create',
            'store',
            'show',
            'destroy'
        ]);

    });


/*
|--------------------------------------------------------------------------
| Temporary Test Route
|--------------------------------------------------------------------------
*/

Route::get(
    '/test-applications',
    [AdminController::class, 'applications']
)->name('test.applications');


/*
|--------------------------------------------------------------------------
| Super Admin
|--------------------------------------------------------------------------
|
| The current project has Admin, Consultant and Student roles.
| Therefore the existing Super Admin dashboard is protected
| using the Admin role.
|
*/

Route::middleware(['auth', 'role:Admin'])
    ->prefix('super-admin')
    ->name('superadmin.')
    ->group(function () {

        Route::get(
            '/dashboard',
            [AdminController::class, 'superAdminDashboard']
        )->name('dashboard');

    });