<?php

// app/Http/Controllers/Admin/CourseController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Department;
use App\Models\CourseGroup;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['department', 'courseGroup'])->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $departments = Department::all();
        $courseGroups = CourseGroup::all();
        return view('admin.courses.create', compact('departments', 'courseGroups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:courses',
            'department_id' => 'required|exists:departments,id',
            'course_group_id' => 'required|exists:course_groups,id',
            'level' => 'required|integer|min:1|max:4',
            'credit_hours' => 'required|integer|min:1',
        ]);

        Course::create($request->all());

        return redirect()->route('admin.courses.index')->with('success', 'تمت إضافة المقرر بنجاح');
    }

    public function edit(Course $course)
    {
        $departments = Department::all();
        $courseGroups = CourseGroup::all();
        return view('admin.courses.edit', compact('course', 'departments', 'courseGroups'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:courses,code,' . $course->id,
            'department_id' => 'required|exists:departments,id',
            'course_group_id' => 'required|exists:course_groups,id',
            'level' => 'required|integer|min:1|max:4',
            'credit_hours' => 'required|integer|min:1',
        ]);

        $course->update($request->all());

        return redirect()->route('admin.courses.index')->with('success', 'تم تحديث المقرر بنجاح');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'تم حذف المقرر بنجاح');
    }
}
