<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('prerequisites')->paginate(20);
        return view('admin.courses.index', compact('courses'));
    }
}

