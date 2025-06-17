<?php

namespace App\Services\Student;

use App\Models\Student;
use App\Models\GradingScale;

class StudentProgressService
{
    public function updateProgress(Student $student)
    {
        $registrations = $student->registrations()->whereNotNull('grade')->get();

        $totalPoints = 0;
        $totalHours  = 0;
        $passedHours = 0;

        foreach ($registrations as $reg) {
            $course = $reg->course;
            $grade = $reg->grade;

            // الحصول على التقدير المناسب من جدول grading_scale
            $grading = GradingScale::where('min_score', '<=', $grade)
                ->where('max_score', '>=', $grade)
                ->first();

            if ($grading) {
                $reg->letter_grade = $grading->letter;
                $reg->gpa_points   = $grading->points;
            } else {
                // fallback
                $reg->letter_grade = 'F';
                $reg->gpa_points   = 0.0;
            }

            $reg->save();

            $totalPoints += $reg->gpa_points * $course->credit_hours;
            $totalHours  += $course->credit_hours;

            if ($grade >= 50) {
                $passedHours += $course->credit_hours;
            }
        }

        $student->total_credits = $passedHours;
        $student->gpa = $totalHours > 0 ? round($totalPoints / $totalHours, 2) : 0;
        $student->level = max(1, ceil($passedHours / 36));
        $student->save();
    }
}
