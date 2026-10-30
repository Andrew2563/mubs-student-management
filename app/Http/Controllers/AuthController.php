<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
           $request->session()->regenerate();
            /** @var \App\Models\User $user */
            $user = Auth::user();
            
            if ($user->hasRole('Administrator')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('Lecturer')) {
                return redirect()->route('lecturer.dashboard');
            } elseif ($user->hasRole('Student')) {
                return redirect()->route('student.dashboard');
            }

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}