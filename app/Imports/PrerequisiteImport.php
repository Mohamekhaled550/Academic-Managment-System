<?php

namespace App\Imports;

use App\Models\Prerequisite;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PrerequisiteImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Prerequisite([
            'course_id' => $row['course_id'],
            'prerequisite_id' => $row['prerequisite_id'],
        ]);
    }
}
