<?php

namespace App\Services\Student;

use App\Models\Student;
use App\Models\GradingScale;

class GPAService
{
   public function recalculateGPA(Student $student): void
    {

    \Log::info('🔄 Recalculating GPA for student ID: ' . $student->id);


        $registrations = $student->registrations()->whereNotNull('grade')->get();

        if ($registrations->isEmpty()) {
            $student->update(['gpa' => null]);
            return;
        }

        $totalPoints = 0;
        $totalCredits = 0;

        foreach ($registrations as $registration) {
            $numericGrade = (int) $registration->grade;

            $scale = GradingScale::where('min_score', '<=', $numericGrade)
                ->where('max_score', '>=', $numericGrade)
                ->first();

            $letter = $scale?->letter ?? 'F';
            $points = $scale?->points ?? 0.0;
            $creditHours = $registration->course->credit_hours;

            // تحديث بيانات التسجيل
            $registration->update([
                'letter_grade' => $letter,
                'gpa_points' => $points,
            ]);

            $totalPoints += $points * $creditHours;
            $totalCredits += $creditHours;

        }

        $gpa = $totalCredits > 0 ? round($totalPoints / $totalCredits, 2) : null;
        $student->update(['gpa' => $gpa]);
        $student->gpa = $gpa;
$student->total_credit_hours = $totalCredits;
$student->save(); // ← ضروري عشان التحديث يتم فعليًا في الداتا بيز
    }
}


