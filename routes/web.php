<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDocumentController;
use App\Http\Controllers\StudentAccountController;
use App\Http\Controllers\StudentNotificationController;
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
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\AdmissionRoadmapController;
use App\Http\Controllers\ApplicationJourneyController;
use App\Http\Controllers\CommunicationHistoryController;
use App\Http\Controllers\CrmDashboardController;
use App\Http\Controllers\CrmAnalyticsController;
use App\Http\Controllers\CrmKpiController;
use App\Http\Controllers\CrmNotificationController;


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

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])
    ->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.update');


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
*/

Route::middleware(['auth', 'role:Student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/dashboard', [StudentController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/profile', [StudentController::class, 'profile'])
            ->name('profile');

        Route::put('/profile', [StudentController::class, 'updateProfile'])
            ->name('profile.update');

        Route::get('/preferences', [StudentController::class, 'preferences'])
            ->name('preferences');

        Route::put('/preferences', [StudentController::class, 'updatePreferences'])
            ->name('preferences.update');

        Route::get('/applications', [StudentController::class, 'applications'])
            ->name('applications');

        Route::get('/recommendations', [StudentController::class, 'recommendations'])
            ->name('recommendations');

        Route::get('/appointments', [StudentController::class, 'appointments'])
            ->name('appointments');

        /*
        |--------------------------------------------------------------------------
        | Study Destination Explorer
        |--------------------------------------------------------------------------
        */

        Route::get('/destinations', [DestinationController::class, 'index'])
            ->name('destinations.index');

        Route::get('/destinations/compare', [DestinationController::class, 'compare'])
            ->name('destinations.compare');

        Route::get('/destinations/{country}', [DestinationController::class, 'show'])
            ->name('destinations.show');

        /*
        |--------------------------------------------------------------------------
        | Admission Roadmap
        |--------------------------------------------------------------------------
        */

        Route::get('/roadmap', [AdmissionRoadmapController::class, 'index'])
            ->name('roadmap.index');

        Route::get('/roadmap/{course}', [AdmissionRoadmapController::class, 'show'])
            ->name('roadmap.show');

        /*
        |--------------------------------------------------------------------------
        | Student Notifications
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/notifications',
            [StudentNotificationController::class, 'index']
        )->name('notifications.index');

        Route::post(
            '/notifications/read-all',
            [StudentNotificationController::class, 'readAll']
        )->name('notifications.read-all');

        Route::get(
            '/notifications/feed',
            [StudentNotificationController::class, 'feed']
        )->name('notifications.feed');

        Route::patch(
            '/notifications/{id}/read',
            [StudentNotificationController::class, 'markRead']
        )->name('notifications.read');

        Route::delete(
            '/notifications/{id}',
            [StudentNotificationController::class, 'destroy']
        )->name('notifications.destroy');

        /*
        |--------------------------------------------------------------------------
        | Qualifications
        |--------------------------------------------------------------------------
        */

        Route::get('/qualifications', [QualificationController::class, 'index'])
            ->name('qualifications');

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

        Route::post('/qualifications/english', [
            QualificationController::class,
            'storeEnglish'
        ])->name('qualifications.english.store');

        Route::post('/qualifications/english/convert', [
           QualificationController::class,
           'convertEnglish'
        ])->name('qualifications.english.convert');

        Route::put('/qualifications/english/{qualification}', [
            QualificationController::class,
            'updateEnglish'
        ])->name('qualifications.english.update');

        Route::delete('/qualifications/english/{qualification}', [
            QualificationController::class,
            'deleteEnglish'
        ])->name('qualifications.english.delete');

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
        | Applications
        |--------------------------------------------------------------------------
        */

        // Application journey: status timeline, deadlines, outstanding requirements.
        Route::get(
            '/applications/{application}/journey',
            [ApplicationJourneyController::class, 'show']
        )->name('applications.journey');

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
        | Recommendations
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

        Route::get(
            'fund-requirements/{fundRequirement}/pdf',
            [FundRequirementController::class, 'downloadPdf']
        )->name('fund-requirements.pdf');

        /*
        |--------------------------------------------------------------------------
        | Documents
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/documents',
            [StudentDocumentController::class, 'index']
        )->name('documents');

        Route::post(
            '/documents',
            [StudentDocumentController::class, 'store']
        )->name('documents.store');

        Route::delete(
            '/documents/{document}',
            [StudentDocumentController::class, 'destroy']
        )->name('documents.destroy');


        /*
        |--------------------------------------------------------------------------
        | Account Settings
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/account-settings',
            [StudentAccountController::class, 'edit']
        )->name('account.edit');

        Route::post(
            '/account-settings/photo',
            [StudentAccountController::class, 'updatePhoto']
        )->name('account.photo.update');

        Route::delete(
            '/account-settings/photo',
            [StudentAccountController::class, 'removePhoto']
        )->name('account.photo.destroy');

        Route::put(
            '/account-settings/password',
            [StudentAccountController::class, 'updatePassword']
        )->name('account.password.update');

        Route::post(
            '/account-settings/deactivate',
            [StudentAccountController::class, 'deactivate']
        )->name('account.deactivate');

    });


/*
|--------------------------------------------------------------------------
| Consultant Portal
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:Consultant'])
    ->prefix('consultant')
    ->name('consultant.')
    ->group(function () {

        Route::get(
            '/dashboard',
            [ConsultantController::class, 'dashboard']
        )->name('dashboard');

        Route::get(
            '/students',
            [ConsultantController::class, 'students']
        )->name('students');

        Route::get(
            '/availability',
            [ConsultantController::class, 'availability']
        )->name('availability');

        Route::get(
            '/appointments',
            [ConsultantController::class, 'appointments']
        )->name('appointments');

        Route::get(
            '/follow-ups',
            [ConsultantController::class, 'followUps']
        )->name('follow-ups');

        Route::get(
            '/settings',
            [ConsultantController::class, 'settings']
        )->name('settings');

    });


/*
|--------------------------------------------------------------------------
| Admin Portal
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:Admin,SuperAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [AdminController::class, 'dashboard']
        )->name('dashboard');

        Route::get(
            '/recent-applications',
            [AdminController::class, 'recentApplications']
        )->name('recent-applications');

        Route::get(
            '/upcoming-appointments',
            [AdminController::class, 'upcomingAppointments']
        )->name('upcoming-appointments');


        /*
        |--------------------------------------------------------------------------
        | User Management
        |--------------------------------------------------------------------------
        */

        // User Management - List
        Route::get(
            '/users',
            [AdminController::class, 'users']
        )->name('users');

        // User Management - Export CSV
        Route::get(
            '/users/export',
            [AdminController::class, 'exportUsers']
        )->name('users.export');

        // User Management - Create
        Route::get(
            '/users/create',
            [AdminController::class, 'createUser']
        )->name('users.create');

        // User Management - Store
        Route::post(
            '/users',
            [AdminController::class, 'storeUser']
        )->name('users.store');

        // User Management - View
        Route::get(
            '/users/{user}',
            [AdminController::class, 'showUser']
        )->name('users.show');

        // User Management - Edit
        Route::get(
            '/users/{user}/edit',
            [AdminController::class, 'editUser']
        )->name('users.edit');

        // User Management - Update
        Route::put(
            '/users/{user}',
            [AdminController::class, 'updateUser']
        )->name('users.update');

        // User Management - Delete
        Route::delete(
            '/users/{user}',
            [AdminController::class, 'destroyUser']
        )->name('users.destroy');

        // User Management - Change Status
        Route::patch(
            '/users/{user}/status',
            [AdminController::class, 'updateUserStatus']
        )->name('users.status');


        /*
        |--------------------------------------------------------------------------
        | Student Management
        |--------------------------------------------------------------------------
        */

        // Student List
        Route::get(
            '/students',
            [AdminController::class, 'students']
        )->name('students');

        // Student Export
        Route::get(
            '/students/export',
            [AdminController::class, 'exportStudents']
        )->name('students.export');

        // Student Create
        Route::get(
            '/students/create',
            [AdminController::class, 'createStudent']
        )->name('students.create');

        // Student Store
        Route::post(
            '/students',
            [AdminController::class, 'storeStudent']
        )->name('students.store');

        // Student View
        Route::get(
            '/students/{student}',
            [AdminController::class, 'showStudent']
        )->name('students.show');

        // Student Edit
        Route::get(
            '/students/{student}/edit',
            [AdminController::class, 'editStudent']
        )->name('students.edit');

        // Student Update
        Route::put(
            '/students/{student}',
            [AdminController::class, 'updateStudent']
        )->name('students.update');

        // Student Change Status
        Route::patch(
            '/students/{student}/status',
            [AdminController::class, 'updateStudentStatus']
        )->name('students.status');

        // Student Delete
        Route::delete(
            '/students/{student}',
            [AdminController::class, 'destroyStudent']
        )->name('students.destroy');


        /*
        |--------------------------------------------------------------------------
        | Other Admin Lists
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/consultants',
            [AdminController::class, 'consultants']
        )->name('consultants');

        Route::get(
            '/countries-list',
            [AdminController::class, 'countries']
        )->name('countries-list');

        Route::get(
            '/universities-list',
            [AdminController::class, 'universities']
        )->name('universities-list');

        Route::get(
            '/courses-list',
            [AdminController::class, 'courses']
        )->name('courses-list');


        /*
        |--------------------------------------------------------------------------
        | Application Management
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/applications-list',
            [AdminController::class, 'applications']
        )->name('applications-list');

        Route::get(
            '/applications-list/{application}',
            [AdminController::class, 'applicationShow']
        )->name('applications-show');

        Route::patch(
            '/applications-list/{application}/status',
            [AdminController::class, 'updateApplicationStatus']
        )->name('applications-status');

        // The status URL is only a form target; if someone reloads it or
        // opens it directly (GET), send them back to the application page.
        Route::get(
            '/applications-list/{application}/status',
            fn (\App\Models\Application $application) => redirect()
                ->route('admin.applications-show', $application)
        );


        /*
        |--------------------------------------------------------------------------
        | Appointments
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/appointments-list',
            [AdminController::class, 'appointments']
        )->name('appointments-list');

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


        /*
        |--------------------------------------------------------------------------
        | Communication History / CRM
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'communication-history',
            CommunicationHistoryController::class
        )->only([
            'index',
            'create',
            'store',
            'destroy'
        ]);


        /*
        |--------------------------------------------------------------------------
        | CRM Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/crm-dashboard',
            [CrmDashboardController::class, 'index']
        )->name('crm-dashboard');


        /*
        |--------------------------------------------------------------------------
        | Analytics Dashboard / CRM
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/analytics',
            [CrmAnalyticsController::class, 'index']
        )->name('analytics');


        /*
        |--------------------------------------------------------------------------
        | KPI Reports / CRM
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/kpi-reports',
            [CrmKpiController::class, 'index']
        )->name('kpi-reports');

        Route::get(
            '/kpi-reports/export',
            [CrmKpiController::class, 'exportPdf']
        )->name('kpi-reports.export');


        /*
        |--------------------------------------------------------------------------
        | Email Notifications / CRM
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'notifications',
            CrmNotificationController::class
        )->only([
            'index',
            'create',
            'store',
            'destroy'
        ]);


        /*
        |--------------------------------------------------------------------------
        | System Settings
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/settings',
            [AdminController::class, 'systemSettings']
        )->name('settings');

        Route::post(
            '/settings',
            [AdminController::class, 'storeSystemSetting']
        )->name('settings.store');

        Route::put(
            '/settings/{setting}',
            [AdminController::class, 'updateSystemSetting']
        )->name('settings.update');

        Route::delete(
            '/settings/{setting}',
            [AdminController::class, 'destroySystemSetting']
        )->name('settings.destroy');

                // Audit Logs
        Route::get('/audit-logs', [
            \App\Http\Controllers\AuditLogController::class,
            'index'
        ])->name('audit-logs.index');

    });


/*
|--------------------------------------------------------------------------
| Super Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:SuperAdmin'])
    ->prefix('super-admin')
    ->name('superadmin.')
    ->group(function () {

        Route::get(
            '/dashboard',
            [AdminController::class, 'superAdminDashboard']
        )->name('dashboard');

    });
