<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;

// Redirect root to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 1. Administrator Dashboard (Protected by 'role:Administrator')
Route::middleware(['auth', 'role:Administrator'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return "Welcome to the Administrator Dashboard!";
    })->name('dashboard');
});

// 2. Lecturer Dashboard (Protected by 'role:Lecturer')
Route::middleware(['auth', 'role:Lecturer'])->prefix('lecturer')->name('lecturer.')->group(function () {
    Route::get('/dashboard', function () {
        return "Welcome to the Lecturer Dashboard!";
    })->name('dashboard');
});

// 3. Student Dashboard Routes (Protected by 'role:Student')
Route::middleware(['auth', 'role:Student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::post('/register-course', [StudentController::class, 'registerCourse'])->name('register.course');
});