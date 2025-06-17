<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Prerequisite;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PrerequisiteImport;
class PrerequisiteController extends Controller
{
    public function index()
    {
        $prerequisites = Prerequisite::with('course', 'prerequisiteCourse')->paginate(10);
        return view('admin.prerequisites.index', compact('prerequisites'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin.prerequisites.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id|different:prerequisite_id',
            'prerequisite_id' => 'required|exists:courses,id',
        ]);

        Prerequisite::create($request->all());

        return redirect()->route('admin.prerequisites.index')->with('success', 'تمت الإضافة بنجاح');
    }

    public function edit(Prerequisite $prerequisite)
    {
        $courses = Course::all();
        return view('admin.prerequisites.edit', compact('prerequisite', 'courses'));
    }

    public function update(Request $request, Prerequisite $prerequisite)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id|different:prerequisite_id',
            'prerequisite_id' => 'required|exists:courses,id',
        ]);

        $prerequisite->update($request->all());

        return redirect()->route('admin.prerequisites.index')->with('success', 'تم التحديث بنجاح');
    }

    public function destroy(Prerequisite $prerequisite)
    {
        $prerequisite->delete();
        return redirect()->route('admin.prerequisites.index')->with('success', 'تم الحذف بنجاح');
    }


    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:csv,xlsx',
    ]);

    Excel::import(new PrerequisiteImport, $request->file('file'));

    return back()->with('success', 'تم استيراد البيانات بنجاح');
}

}
