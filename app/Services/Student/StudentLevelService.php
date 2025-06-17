<?php


namespace App\Services\Student;

use App\Models\Student;

class StudentLevelService
{
    public function updateStudentLevel(Student $student): void
    {
        $totalHours = $student->registrations()
            ->whereNotNull('grade')
            ->with('course')
            ->get()
            ->sum(fn($r) => $r->course->credit_hours);

        $newLevel = match (true) {
            $totalHours >= 108 => 4,
            $totalHours >= 72 => 3,
            $totalHours >= 36 => 2,
            default => 1,
        };

        $student->update(['level' => $newLevel]);
    }
}

