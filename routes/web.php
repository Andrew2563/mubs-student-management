<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LecturerController;
use App\Models\Student;
use App\Models\Course;
use App\Models\CourseRegistration;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    if (!$user) {
        return redirect('/login');
    }

    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    }
    if ($user->role === 'lecturer') {
        return redirect('/lecturer/dashboard');
    }
    return redirect('/student/dashboard');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

// 1. Administrator Dashboard & Action Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/students/create', function () {
        return view('admin.students-create');
    })->name('students.create');
    Route::post('/students/store', [AdminController::class, 'storeStudent'])->name('students.store');

    Route::get('/lecturers/create', function () {
        return view('admin.lecturers-create');
    })->name('lecturers.create');
    Route::post('/lecturers/store', [AdminController::class, 'storeLecturer'])->name('lecturers.store');

    Route::get('/courses/create', function () {
        return view('admin.courses-create');
    })->name('courses.create');
    Route::post('/courses/store', [AdminController::class, 'storeCourse'])->name('courses.store');

    Route::get('/permissions', [AdminController::class, 'permissions'])->name('permissions');
});

// 2. Lecturer Dashboard & Course Action Routes
Route::middleware(['auth'])->prefix('lecturer')->name('lecturer.')->group(function () {
    Route::get('/dashboard', [LecturerController::class, 'dashboard'])->name('dashboard');

    Route::get('/courses/{id}/students', [LecturerController::class, 'viewStudents'])->name('courses.students');
    Route::get('/courses/{id}/marks', [LecturerController::class, 'enterMarks'])->name('courses.marks');

    // Add this POST route to handle saving marks:
    Route::post('/courses/{id}/marks', [LecturerController::class, 'storeMarks'])->name('courses.marks.store');
});

// 3. Student Dashboard Route (Completely untouched & safe)
Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', [\App\Http\Controllers\StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::post('/student/register-course', [\App\Http\Controllers\StudentController::class, 'registerCourse'])->name('student.register.course');
});

 // Auto-Seed Route for 5 Unique Students
Route::get('/auto-seed-data', function () {
    $students = [
        ['name' => 'John Doe', 'student_number' => '23/U/1001', 'email' => 'john@mubs.ac.ug'],
        ['name' => 'Mary Namubiru', 'student_number' => '23/U/1002', 'email' => 'mary@mubs.ac.ug'],
        ['name' => 'Brian Okello', 'student_number' => '23/U/1003', 'email' => 'brian@mubs.ac.ug'],
        ['name' => 'Aisha Nakato', 'student_number' => '23/U/1004', 'email' => 'aisha@mubs.ac.ug'],
        ['name' => 'Paul Kiggundu', 'student_number' => '23/U/1005', 'email' => 'paul@mubs.ac.ug'],
    ];

    foreach ($students as $data) {
       $user = \App\Models\User::firstOrCreate(
            ['email' => $data['email']],
            [
                'name' => $data['name'],
                'password' => bcrypt('password123'),
                'role' => 'student'
            ]
        );

        $student = Student::firstOrCreate(
            ['student_number' => $data['student_number']],
            [
                'name' => $data['name'],
                'registration_number' => $data['student_number'],
                'program' => 'Bachelors in Business Computing',
                'academic_year' => '2025/2026',
                'user_id' => $user->id
            ]
        );

        $student->update(['name' => $data['name'], 'user_id' => $user->id]);

        foreach (Course::all() as $course) {
            CourseRegistration::firstOrCreate([
                'student_id' => $student->id,
                'course_id' => $course->id,
            ], [
                'status' => 'Registered'
            ]);
        }
    }

    return redirect('/lecturer/dashboard')->with('success', '5 unique student records seeded!');
});

// Temporary Helper Route
Route::get('/make-me-student', function () {
    $user = Auth::user();
    if ($user) {
        DB::table('users')->where('id', $user->id)->update(['role' => 'student']);
        return redirect('/student/dashboard');
    }
    return redirect('/login');
});
