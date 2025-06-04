<?php

namespace App\Services\Student;

use App\Models\Student;
use Illuminate\Support\Facades\DB;

class CreditHourService
{
    public function getMaxAllowed(Student $student): int
    {
        $isNew = $this->isNewStudent($student);

        return $isNew ? 18 : ($student->gpa >= 2 ? 18 : 12);
    }

    public function isNewStudent(Student $student): bool
    {
        return $student->level == 1 &&
            $student->total_credits == 0 &&
            $student->gpa == 0 &&
            DB::table('registrations')->where('student_id', $student->id)->count() == 0;
    }
}
