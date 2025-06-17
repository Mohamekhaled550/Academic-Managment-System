<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseOffering;
use App\Models\Term;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CourseOfferingImport;

class CourseOfferingController extends Controller
{
    public function index()
    {
        $offerings = CourseOffering::with('course', 'term')->get();
        return view('admin.offerings.index', compact('offerings'));
    }

    public function create()
    {
        $courses = Course::all();
        $terms = Term::all();
        return view('admin.offerings.create', compact('courses', 'terms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'term_id' => 'required|exists:terms,id',
            'section' => 'nullable|string',
            'level' => 'required|integer|min:1|max:4',
            'is_elective' => 'boolean',
        ]);

        CourseOffering::create($request->all());

        return redirect()->route('admin.offerings.index')->with('success', 'تمت الإضافة بنجاح');
    }

    public function edit(CourseOffering $courseOffering)
    {
        $courses = Course::all();
        $terms = Term::all();
        return view('admin.offerings.edit', compact('courseOffering', 'courses', 'terms'));
    }

    public function update(Request $request, CourseOffering $courseOffering)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'term_id' => 'required|exists:terms,id',
            'section' => 'nullable|string',
            'level' => 'required|integer|min:1|max:4',
            'is_elective' => 'boolean',
        ]);

        $courseOffering->update($request->all());

        return redirect()->route('admin.offerings.index')->with('success', 'تم التحديث بنجاح');
    }

    public function destroy(CourseOffering $courseOffering)
    {
        $courseOffering->delete();
        return redirect()->route('admin.offerings.index')->with('success', 'تم الحذف بنجاح');
    }


    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:csv,xlsx',
    ]);

    Excel::import(new CourseOfferingImport, $request->file('file'));

    return back()->with('success', 'تم استيراد البيانات بنجاح');
}
}
