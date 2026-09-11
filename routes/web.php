<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ConsultantController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('public.home');
});

Route::get('/student/dashboard', [StudentController::class, 'dashboard'])
    ->name('student.dashboard');

Route::get('/consultant/dashboard', [ConsultantController::class, 'dashboard'])
    ->name('consultant.dashboard');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');

Route::get('/super-admin/dashboard', [AdminController::class, 'superAdminDashboard'])
    ->name('superadmin.dashboard');
