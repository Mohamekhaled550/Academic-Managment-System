<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Term;

class TermController extends Controller
{
    public function index()
    {
        $terms = Term::latest()->paginate(10);
        return view('admin.terms.index', compact('terms'));
    }
}

