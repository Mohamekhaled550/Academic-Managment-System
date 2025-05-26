<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Registration;
use App\Models\Term;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function availableCourses()
    {
        $student = Auth::guard('student')->user();
        $this->calculateAndUpdateGPA($student);

        $lastTermId = $student->registrations()->latest('term_id')->value('term_id');

        $nextTerm = $lastTermId
            ? Term::where('id', '>', $lastTermId)->orderBy('id')->first()
            : Term::where('level', $student->level)->orderBy('year')->orderBy('semester')->first();

        if (!$nextTerm) {
            return back()->with('error', 'لا يوجد ترم مناسب حالياً لهذا الطالب.');
        }

        $term = $nextTerm;

        $isNewStudent = $student->level == 1 && $student->total_credits == 0 && $student->gpa == 0 &&
            $student->registrations()->count() == 0;

        $maxHours = $isNewStudent ? 18 : ($student->gpa >= 2 ? 18 : 12);
        $minHours = 12;

        $passedCourses = $student->registrations()->where('grade', '>=', 50)->pluck('course_id')->toArray();
        $failedCourses = $student->registrations()->where('grade', '<', 50)->pluck('course_id')->toArray();

        $availableCourses = Course::whereHas('offerings', fn($q) => $q->where('term_id', $term->id))
            ->where(function ($query) use ($passedCourses) {
                $query->whereDoesntHave('prerequisites')
                      ->orWhereHas('prerequisites', fn($q) => $q->whereIn('prerequisite_id', $passedCourses));
            })
            ->whereNotIn('id', $passedCourses)
            ->whereDoesntHave('registrations', fn($q) => $q->where('student_id', Auth::id())->where('term_id', $term->id))
            ->get();

        $failedCoursesList = Course::whereIn('id', $failedCourses)
            ->whereHas('offerings', fn($q) => $q->where('term_id', $term->id))
            ->get();

        $availableCourses = $availableCourses->merge($failedCoursesList)->unique('id');

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

        $totalHours = Course::whereIn('id', $request->courses)->sum('credit_hours');

        $this->calculateAndUpdateGPA($student);

        $isNewStudent = $student->gpa == 0 && $student->total_credits == 0 &&
            $student->registrations()->count() == 0;
        $maxHours = $isNewStudent ? 18 : ($student->gpa >= 2 ? 18 : 12);

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

            $totalGradePoints += $gradePoint * $creditHours;
            $totalCredits += $creditHours;
        }

        $student->gpa = $totalCredits > 0 ? round($totalGradePoints / $totalCredits, 2) : 0;
        $student->total_credits = $totalCredits;

        $newLevel = floor($totalCredits / 36) + 1;
        if ($newLevel > $student->level && $newLevel <= 8) {
            $student->level = $newLevel;
        }

        $student->save();
    }
}
