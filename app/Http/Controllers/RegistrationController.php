<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Registration;
use App\Models\Term;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{


    public function availableCourses()
    {
        $student = Auth::guard('student')->user();

        $this->calculateAndUpdateGPA($student);

       $lastTermId = $student->registrations()
    ->latest('term_id')
    ->value('term_id');

$nextTerm = null;

if ($lastTermId) {
    // نجيب الترم اللي بعده في جدول الترمات بناء على ترتيب الـ ID
    $nextTerm = Term::where('id', '>', $lastTermId)
        ->orderBy('id')
        ->first();
} else {
    // أول مرة يسجل، نختار أول ترم في مستواه
    $nextTerm = Term::where('level', $student->level)
        ->orderBy('year')
        ->orderBy('semester')
        ->first();
}

if (!$nextTerm) return back()->with('error', 'لا يوجد ترم مناسب حالياً لهذا الطالب.');

$term = $nextTerm;

$isNewStudent = $student->level == 1 &&
                $student->total_credits == 0 &&
                $student->gpa == 0 &&
                DB::table('registrations')->where('student_id', $student->id)->count() == 0;

// نحدد الساعات المسموح بها
if ($isNewStudent) {
    $maxHours = 18;
} else {
    $maxHours = $student->gpa >= 2 ? 18 : 12;
}

        $passedCourses = $student->registrations()->where('grade', '>=', 50)->pluck('course_id')->toArray();
        $failedCourses = $student->registrations()->where('grade', '<', 50)->pluck('course_id')->toArray();

        $minHours = 12;

        $availableCourses = Course::where(function ($query) use ($student, $term) {
              $query->whereHas('offerings', fn($q) => $q->where('term_id', $term->id));
            })
            ->where(function ($query) use ($passedCourses) {
                $query->whereDoesntHave('prerequisites')
                      ->orWhereHas('prerequisites', fn($q) => $q->whereIn('prerequisite_id', $passedCourses));
            })
            ->whereNotIn('id', $passedCourses)
            ->whereDoesntHave('registrations', fn($q) => $q->where('student_id', $student->id)->where('term_id', $term->id))
            ->get();

        // إضافة المواد الراسبة بشرط أن تكون معروضة في الترم الحالي
        $failedCoursesList = Course::whereIn('id', $failedCourses)
            ->whereHas('offerings', fn($q) => $q->where('term_id', $term->id))
            ->get();

        $availableCourses = $availableCourses->merge($failedCoursesList)->unique('id');

        return view('student.register', compact('availableCourses', 'term', 'maxHours', 'minHours'));
    }

     // حساب المعدل وتحديث الطالب تلقائيًا
    private function calculateAndUpdateGPA($student)
    {
        $registrations = Registration::where('student_id', $student->id)
            ->whereNotNull('grade')
            ->get();

        $totalGradePoints = 0;
        $totalCredits = 0;

        foreach ($registrations as $registration) {
            $course = Course::find($registration->course_id);
            if (!$course) continue;

            $creditHours = $course->credit_hours;
            $grade = $registration->grade;

            // تحويل الدرجة إلى نقاط
            $gradePoint = match (true) {
                $grade >= 90 => 4.0,
                $grade >= 85 => 3.7,
                $grade >= 80 => 3.3,
                $grade >= 75 => 3.0,
                $grade >= 70 => 2.7,
                $grade >= 65 => 2.3,
                $grade >= 60 => 2.0,
                $grade >= 50 => 1.0,
                default => 0.0
            };

            // فقط المواد الناجحة تُحتسب في الساعات والمعدل
                $totalGradePoints += $gradePoint * $creditHours;
                $totalCredits += $creditHours;

        }

        // تحديث المعدل والساعات والمستوى
        $student->gpa = $totalCredits > 0 ? round($totalGradePoints / $totalCredits, 2) : 0;
        $student->total_credits = $totalCredits;

        // ترقية المستوى بعد اجتياز 36 ساعة
       $newLevel = floor($totalCredits / 36) + 1;

if ($newLevel > $student->level && $newLevel <= 8) {
    $student->level = $newLevel;
}
        $student->save();
    }
    public function register(Request $request)
    {
        $student = Auth::guard('student')->user();

        $request->validate([
            'term_id' => 'required|exists:terms,id',
            'courses' => 'required|array',
            'courses.*' => 'exists:courses,id',
        ]);

        $totalHours = Course::whereIn('id', $request->courses)->sum('credit_hours');

        $this->calculateAndUpdateGPA($student); // تحديث المعدل قبل التحقق

        $isNewStudent = $student->gpa == 0 && $student->total_credits == 0 &&
        DB::table('registrations')->where('student_id', $student->id)->count() == 0;
        $maxHours = $isNewStudent ? 18 : ($student->gpa >= 2 ? 18 : 12);

       if ($totalHours < 12 || $totalHours > $maxHours) {
    if ($isNewStudent) {
        return back()->with('error', 'الطلاب المستجدين يمكنهم التسجيل فقط من 12 إلى 18 ساعة.');
    } else {
        return back()->with('error', "مسموح بالتسجيل من 12 إلى {$maxHours} ساعة فقط.");
    }
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
