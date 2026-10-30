<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Course;
use App\Models\CourseRegistration;

class StudentController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        if (!$student) {
            return redirect()->route('login')->with('error', 'Student profile not found.');
        }

        $registeredCourses = CourseRegistration::with('course')
            ->where('student_id', $student->id)
            ->where('academic_year', '2026/2027')
            ->get();

        $allCourses = Course::all();

        return view('student.dashboard', compact('student', 'registeredCourses', 'allCourses'));
    }

    public function registerCourse(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        if (!$student) {
            return back()->with('error', 'Student profile not found.');
        }

        // Check if already registered for this course
        $exists = CourseRegistration::where('student_id', $student->id)
            ->where('course_id', $request->course_id)
            ->where('academic_year', '2026/2027')
            ->exists();

        if ($exists) {
            return back()->with('error', 'You are already registered for this course.');
        }

        CourseRegistration::create([
            'student_id' => $student->id,
            'course_id' => $request->course_id,
            'academic_year' => '2026/2027',
            'semester' => 1,
        ]);

        return back()->with('success', 'Course registered successfully!');
    }
}