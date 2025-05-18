<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.student_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'national_id' => 'required|exists:students,national_id',
        ]);

        $student = \App\Models\Student::where('national_id', $request->national_id)->first();

        Auth::guard('student')->login($student);

        return redirect()->route('student.dashboard'); // غيرها حسب اللي عندك
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('student.login');
    }
}
