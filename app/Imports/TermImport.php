<?php

namespace App\Imports;

use App\Models\Term;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class TermImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Term([
            'name' => $row['name'],
            'level' => $row['level'],
            'is_active' => $row['is_active'],
            'registration_start_date' => $row['registration_start_date'],
            'registration_end_date' => $row['registration_end_date'],
            'year' => $row['year'],
            'semester' => $row['semester'],
        ]);
    }
}
