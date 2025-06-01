<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Department;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('department')->latest()->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.students.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'national_id' => 'required|string|unique:students,national_id',
            'department_id' => 'required|exists:departments,id',
            'level' => 'required|integer|min:1|max:4',
            'email' => 'required|email|unique:students,email',
            'gpa' => 'required|numeric',
            'total_credits' => 'required|integer',
            'status' => 'required|in:active,graduated,suspended',
        ]);

        Student::create($request->all());

        return redirect()->route('admin.students.index')->with('success', 'تمت إضافة الطالب بنجاح.');
    }

    public function edit(Student $student)
    {
        $departments = Department::all();
        return view('admin.students.edit', compact('student', 'departments'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
             'name' => 'required|string',
            'national_id' => 'required|string|unique:students,national_id' . $student->id,
            'department_id' => 'required|exists:departments,id',
            'level' => 'required|integer|min:1|max:4',
            'email' => 'required|email|unique:students,email'  . $student->id,
            'gpa' => 'required|numeric',
            'total_credits' => 'required|integer',
            'status' => 'required|in:active,graduated,suspended',
        ]);

        $student->update($request->all());

        return redirect()->route('admin.students.index')->with('success', 'تم تعديل بيانات الطالب بنجاح.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')->with('success', 'تم حذف الطالب بنجاح.');
    }
}
