<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DepartmentImport;
class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->get();
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:departments,code',
            'name' => 'required|string',
        ]);

        Department::create($request->only('code', 'name'));

        return redirect()->route('admin.departments.index')->with('success', 'تم إضافة القسم بنجاح');
    }

    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'code' => 'required|unique:departments,code,' . $department->id,
            'name' => 'required|string',
        ]);

        $department->update($request->only('code', 'name'));

        return redirect()->route('admin.departments.index')->with('success', 'تم تعديل القسم بنجاح');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('admin.departments.index')->with('success', 'تم حذف القسم بنجاح');
    }


    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:csv,xlsx',
    ]);

    Excel::import(new DepartmentImport, $request->file('file'));

    return back()->with('success', 'تم استيراد البيانات بنجاح');
}
}

