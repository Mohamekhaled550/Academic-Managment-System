<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'national_id' => 'required|exists:students,national_id',
        ]);

        $student = Student::where('national_id', $request->national_id)->first();

        Auth::guard('student')->login($student);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::guard('student')->logout();

        return redirect()->route('login');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
