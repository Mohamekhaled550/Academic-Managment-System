<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Registration;
use App\Services\StudentService;
use App\Services\Student\GPAService;
use App\Services\Student\TermService;
use App\Services\Student\CreditHourService;
use App\Services\Student\CourseAvailabilityService;

class RegistrationController extends Controller
{
    protected StudentService $studentService;

    public function __construct(
        protected GPAService $gpaService,
        protected TermService $termService,
        protected CreditHourService $creditHourService,
        protected CourseAvailabilityService $courseAvailabilityService,
    ) {}

    public function availableCourses()
    {
        $student = Auth::guard('student')->user();
        $this->gpaService->calculateAndUpdate($student);

        $term = $this->termService->determineNext($student);
        if (!$term) return back()->with('error', 'لا يوجد ترم مناسب حالياً لهذا الطالب.');

        $maxHours = $this->creditHourService->getMaxAllowed($student);
        $minHours = 12;

        $availableCourses = $this->courseAvailabilityService->getAvailable($student, $term);

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

        $this->gpaService->calculateAndUpdate($student);

        $maxHours = $this->creditHourService->getMaxAllowed($student);
        $minHours = 12;
        $total = Course::whereIn('id', $request->courses)->sum('credit_hours');

        if ($total < $minHours || $total > $maxHours) {
            return back()->with('error', "مسموح بالتسجيل من {$minHours} إلى {$maxHours} ساعة.");
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
