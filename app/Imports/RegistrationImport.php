<?php

namespace App\Imports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RegistrationImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Registration([
            'student_id' => $row['student_id'],
            'course_id' => $row['course_id'],
            'term_id' => $row['term_id'],
            'grade' => $row['grade'],
            'is_retake' => $row['is_retake'],
        ]);
    }
}
