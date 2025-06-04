<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $student = Auth::guard('student')->user();
        return view('student.profile', compact('student'));
    }

    public function showMyRegistrations()
{
    $student = auth()->user(); // الطالب المسجل الدخول
    $student->load(['department', 'registrations.course', 'registrations.term']);

    return view('student.my-registrations', compact('student'));
}

}
