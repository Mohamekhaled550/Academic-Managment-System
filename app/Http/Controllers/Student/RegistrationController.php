<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Registration;
use App\Services\StudentService;

class RegistrationController extends Controller
{
    protected StudentService $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function availableCourses()
    {
        $student = Auth::guard('student')->user();

        $this->studentService->calculateAndUpdateGPA($student);

        $term = $this->studentService->determineNextTerm($student);

        if (!$term) {
            return back()->with('error', 'لا يوجد ترم مناسب حالياً لهذا الطالب.');
        }

        $maxHours = $this->studentService->getAllowedCreditHours($student);
        $minHours = 12;

        $availableCourses = $this->studentService->getAvailableCourses($student, $term);

        return view('student.register', compact('availableCourses', 'term', 'maxHours', 'minHours'));
    }

    public function register(Request $request)
    {
        $student = Auth::guard('student')->user();

        $request->validate([
            'term_id' => 'required|exists:terms,id',
            'courses' => 'required|array',
            'courses.*' => 'exists:courses,id',
        ]);

        $this->studentService->calculateAndUpdateGPA($student);

        $isNewStudent = $this->studentService->isNewStudent($student);
        $maxHours = $this->studentService->getAllowedCreditHours($student);
        $totalHours = Course::whereIn('id', $request->courses)->sum('credit_hours');

        if ($totalHours < 12 || $totalHours > $maxHours) {
            $msg = $isNewStudent
                ? 'الطلاب المستجدين يمكنهم التسجيل فقط من 12 إلى 18 ساعة.'
                : "مسموح بالتسجيل من 12 إلى {$maxHours} ساعة فقط.";
            return back()->with('error', $msg);
        }

        foreach ($request->courses as $courseId) {
            Registration::create([
                'student_id' => $student->id,
                'course_id' => $courseId,
                'term_id' => $request->term_id,
            ]);
        }

        return redirect()->route('student.dashboard')->with('success', 'تم التسجيل بنجاح.');
    }
}
