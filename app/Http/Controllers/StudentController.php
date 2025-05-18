<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Registration;
use App\Models\RegistrationPeriod;
use App\Models\Term;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student = Auth::guard('student')->user();
        return view('student.dashboard', compact('student'));
    }

    public function profile()
    {
        $student = Auth::guard('student')->user();
        return view('student.profile', compact('student'));
    }




}

