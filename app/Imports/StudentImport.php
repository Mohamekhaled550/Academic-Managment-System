<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class StudentImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
                     'name' => $row['name'],
                     'department_id' => $row['department_id'],
                     'national_id' => $row['national_id'],
                     'email' => $row['email'],
                     'gpa' => $row['gpa'],
                     'total_credits' => $row['total_credits'],
                     'status' => $row['status'],
                     'level' => $row['level'],

        ]);
    }
}
