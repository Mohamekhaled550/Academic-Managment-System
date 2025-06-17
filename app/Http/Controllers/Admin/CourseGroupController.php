<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseGroup;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CourseGroupImport;
class CourseGroupController extends Controller
{
    public function index()
    {
        $groups = CourseGroup::latest()->get();
        return view('admin.course_groups.index', compact('groups'));
    }

    public function create()
    {
        return view('admin.course_groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'code' => 'required|numeric|unique:course_groups,code',
        ]);

        CourseGroup::create($request->only('name', 'code'));

        return redirect()->route('admin.course-groups.index')->with('success', 'تمت إضافة المجموعة بنجاح');
    }

    public function edit(CourseGroup $courseGroup)
    {
        return view('admin.course_groups.edit', compact('courseGroup'));
    }

    public function update(Request $request, CourseGroup $courseGroup)
    {
        $request->validate([
            'name' => 'required|string',
            'code' => 'required|numeric|unique:course_groups,code,' . $courseGroup->id,
        ]);

        $courseGroup->update($request->only('name', 'code'));

        return redirect()->route('admin.course-groups.index')->with('success', 'تم تعديل المجموعة بنجاح');
    }

    public function destroy(CourseGroup $courseGroup)
    {
        $courseGroup->delete();
        return redirect()->route('admin.course-groups.index')->with('success', 'تم حذف المجموعة بنجاح');
    }


    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:csv,xlsx',
    ]);

    Excel::import(new CourseGroupImport, $request->file('file'));

    return back()->with('success', 'تم استيراد البيانات بنجاح');
}
}
