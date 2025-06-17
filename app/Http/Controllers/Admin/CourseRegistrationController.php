<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Student;
use App\Models\Course;
use App\Models\Term;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RegistrationImport;

class CourseRegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::with(['student', 'course', 'term'])->latest()->paginate(10);
        return view('admin.registrations.index', compact('registrations'));
    }

    public function create()
    {
        $students = Student::all();
        $courses = Course::all();
        $terms = Term::all();
        return view('admin.registrations.create', compact('students', 'courses', 'terms'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'term_id' => 'required|exists:terms,id',
            'grade' => 'nullable|numeric|min:0|max:100',
            'is_retake' => 'boolean',
        ]);

        Registration::create($data);
        return redirect()->route('admin.registrations.index')->with('success', 'تم تسجيل المادة بنجاح.');
    }

    public function edit(Registration $registration)
    {
        $students = Student::all();
        $courses = Course::all();
        $terms = Term::all();
        return view('admin.registrations.edit', compact('registration', 'students', 'courses', 'terms'));
    }

    public function update(Request $request, Registration $registration)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'term_id' => 'required|exists:terms,id',
            'grade' => 'nullable|numeric|min:0|max:100',
            'is_retake' => 'boolean',
        ]);

        $registration->update($data);
        return redirect()->route('admin.registrations.index')->with('success', 'تم تحديث التسجيل.');
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();
        return redirect()->route('admin.registrations.index')->with('success', 'تم الحذف.');
    }



    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:csv,xlsx',
    ]);

    Excel::import(new RegistrationImport, $request->file('file'));

    return back()->with('success', 'تم استيراد البيانات بنجاح');
}
}
