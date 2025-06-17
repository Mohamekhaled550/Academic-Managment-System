<?php

namespace App\Services\Student;

use App\Models\Student;

class CreditHourService
{
    public function getMinMaxHours(Student $student): array
    {
 $gpa = $student->gpa;
 $hasPreviousRegistrations = $student->registrations()->exists();

    // الطالب مستجد (لم يسجل أي مقررات قبل كده)
    if (!$hasPreviousRegistrations) {
        return [12, 18];
    }

    if ($gpa >= 3.7) {
        return [12, 21];
    } elseif ($gpa >= 2.0) {
        return [12, 18];
    } else {
        return [9, 12];
    }
    }
}
