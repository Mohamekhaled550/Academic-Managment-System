<?php

namespace App\Services\Student;

use App\Models\Course;
use App\Models\Registration;
use App\Models\Student;

class GPAService
{
    public function calculateAndUpdate(Student $student): void
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

        // تحديث المستوى تلقائياً
        $newLevel = floor($totalCredits / 36) + 1;
        if ($newLevel > $student->level && $newLevel <= 8) {
            $student->level = $newLevel;
        }

        $student->save();
    }
}

