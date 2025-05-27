<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Registration;
use App\Models\Term;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentService
{
    public function calculateAndUpdateGPA(Student $student): void
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

    public function determineNextTerm(Student $student): ?Term
    {
        $lastTermId = $student->registrations()
            ->latest('term_id')
            ->value('term_id');

        if ($lastTermId) {
            return Term::where('id', '>', $lastTermId)
                ->orderBy('id')
                ->first();
        }

        return Term::where('level', $student->level)
            ->orderBy('year')
            ->orderBy('semester')
            ->first();
    }

    public function getAllowedCreditHours(Student $student): int
    {
        $isNewStudent = $student->level == 1 &&
                        $student->total_credits == 0 &&
                        $student->gpa == 0 &&
                        DB::table('registrations')->where('student_id', $student->id)->count() == 0;

        return $isNewStudent ? 18 : ($student->gpa >= 2 ? 18 : 12);
    }

    public function getAvailableCourses(Student $student, Term $term): array
    {
        $passedCourses = $student->registrations()->where('grade', '>=', 50)->pluck('course_id')->toArray();
        $failedCourses = $student->registrations()->where('grade', '<', 50)->pluck('course_id')->toArray();

        $availableCourses = Course::whereHas('offerings', fn($q) => $q->where('term_id', $term->id))
            ->where(function ($query) use ($passedCourses) {
                $query->whereDoesntHave('prerequisites')
                    ->orWhereHas('prerequisites', fn($q) => $q->whereIn('prerequisite_id', $passedCourses));
            })
            ->whereNotIn('id', $passedCourses)
            ->whereDoesntHave('registrations', fn($q) => $q->where('student_id', $student->id)->where('term_id', $term->id))
            ->get();

        $failedCoursesList = Course::whereIn('id', $failedCourses)
            ->whereHas('offerings', fn($q) => $q->where('term_id', $term->id))
            ->get();

        return $availableCourses->merge($failedCoursesList)->unique('id')->values()->all();
    }

    public function isNewStudent(Student $student): bool
    {
        return $student->level == 1 &&
            $student->total_credits == 0 &&
            $student->gpa == 0 &&
            DB::table('registrations')->where('student_id', $student->id)->count() == 0;
    }
}
