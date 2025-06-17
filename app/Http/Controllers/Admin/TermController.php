<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TermImport;

class TermController extends Controller
{
    public function index()
    {
        $terms = Term::latest()->paginate(10);
        return view('admin.terms.index', compact('terms'));
    }

    public function create()
    {
        return view('admin.terms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'year' => 'required|integer',
            'semester' => 'required|integer|min:1|max:3',
            'level' => 'required|integer|min:1|max:4',
            'registration_start_date' => 'nullable|date',
            'registration_end_date' => 'nullable|date|after_or_equal:registration_start_date',
            'is_active' => 'boolean'
        ]);

$data = $request->all();
$data['is_active'] = $request->has('is_active'); // يتحول لـ true/false

$term->update($data);


        return redirect()->route('admin.terms.index')->with('success', 'تم إنشاء الترم بنجاح');
    }

    public function edit(Term $term)
    {
        return view('admin.terms.edit', compact('term'));
    }

    public function update(Request $request, Term $term)
    {
        $request->validate([
            'name' => 'required|string',
            'year' => 'required|integer',
            'semester' => 'required|integer|min:1|max:3',
            'level' => 'required|integer|min:1|max:4',
            'registration_start_date' => 'nullable|date',
            'registration_end_date' => 'nullable|date|after_or_equal:registration_start_date',
            'is_active' => 'boolean'
        ]);

$data = $request->all();
$data['is_active'] = $request->has('is_active'); // يتحول لـ true/false

$term->update($data);
        return redirect()->route('admin.terms.index')->with('success', 'تم تعديل بيانات الترم');
    }

    public function destroy(Term $term)
    {
        $term->delete();
        return redirect()->route('admin.terms.index')->with('success', 'تم حذف الترم');
    }


    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:csv,xlsx',
    ]);

    Excel::import(new TermImport, $request->file('file'));

    return back()->with('success', 'تم استيراد البيانات بنجاح');
}


}
