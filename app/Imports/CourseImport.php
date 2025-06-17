<?php

namespace App\Imports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Course([
                   'name' => $row['name'],
                   'code' => $row['code'],
                   'department_id' => $row['department_id'],
                   'course_group_id' => $row['course_group_id'],
                   'level' => $row['level'],
                   'credit_hours' => $row['credit_hours'],
                   'is_elective' => $row['is_elective'],
                   'is_project' => $row['is_project'],

        ]);
    }
}
