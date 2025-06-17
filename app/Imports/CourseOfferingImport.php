<?php

namespace App\Imports;

use App\Models\CourseOffering;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseOfferingImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CourseOffering([
            'course_id' => $row['course_id'],
            'term_id' => $row['term_id'],
            'section' => $row['section'],
            'level' => $row['level'],
            'is_elective' => $row['is_elective'],


        ]);
    }
}
