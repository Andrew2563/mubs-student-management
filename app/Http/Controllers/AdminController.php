<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        $courses = Course::all(); // Fetch all courses from database
        return view('admin.dashboard', compact('users', 'courses'));
    }

    public function storeStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'program' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('Password123!'),
        ]);

        $user->assignRole('student');

        return redirect()->route('admin.dashboard')->with('success', 'Student registered successfully!');
    }

    public function storeLecturer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'department' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('LecturerPassword123!'),
        ]);

        $user->assignRole('lecturer');

        return redirect()->route('admin.dashboard')->with('success', 'Lecturer added successfully!');
    }

    public function storeCourse(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:courses,code',
            'name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1',
        ]);

        Course::create([
            'code' => $request->code,
            'name' => $request->name,
            'credits' => $request->credits,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Course module ' . $request->code . ' created and saved successfully!');
    }

    public function permissions()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.permissions', compact('roles', 'permissions'));
    }
}
