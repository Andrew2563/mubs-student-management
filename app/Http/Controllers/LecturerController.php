<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student; // Add this import

class LecturerController extends Controller
{
    public function dashboard()
    {
        $courses = Course::all();
        return view('lecturer.dashboard', compact('courses'));
    }

   public function viewStudents($courseId)
{
    $course = Course::findOrFail($courseId);

    // Fetch unique students registered for this course
    $students = Student::whereHas('registrations', function ($query) use ($courseId) {
        $query->where('course_id', $courseId);
    })->get();

    return view('lecturer.students', compact('course', 'students'));
}
    public function enterMarks($id)
    {
    $course = Course::findOrFail($id);

    // Fetch unique students registered for this course
    $students = Student::whereHas('registrations', function ($query) use ($id) {
        $query->where('course_id', $id);
    })->get();

    return view('lecturer.marks-entry', compact('course', 'students'));
}

    public function storeMarks(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $marks = $request->input('marks', []);

        foreach ($marks as $studentId => $scores) {
            CourseRegistration::updateOrCreate(
                [
                    'course_id' => $course->id,
                    'student_id' => $studentId,
                ],
                [
                    'coursework' => $scores['coursework'] ?? null,
                    'exam' => $scores['exam'] ?? null,
                ]
            );
        }

        return redirect()->back()->with('success', 'Marks saved successfully.');
    }
}
