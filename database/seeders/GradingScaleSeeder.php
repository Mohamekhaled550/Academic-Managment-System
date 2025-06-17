<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradingScaleSeeder extends Seeder
{
    public function run()
    {
        DB::table('grading_scale')->insert([
            ['min_score' => 90, 'max_score' => 100, 'letter' => 'A',  'points' => 4.0],
            ['min_score' => 85, 'max_score' => 89, 'letter' => 'A-', 'points' => 3.7],
            ['min_score' => 80, 'max_score' => 84, 'letter' => 'B+', 'points' => 3.3],
            ['min_score' => 75, 'max_score' => 79, 'letter' => 'B',  'points' => 3.0],
            ['min_score' => 70, 'max_score' => 74, 'letter' => 'B-', 'points' => 2.7],
            ['min_score' => 65, 'max_score' => 69, 'letter' => 'C+', 'points' => 2.3],
            ['min_score' => 60, 'max_score' => 64, 'letter' => 'C',  'points' => 2.0],
            ['min_score' => 55, 'max_score' => 59, 'letter' => 'D+', 'points' => 1.7],
            ['min_score' => 50, 'max_score' => 54, 'letter' => 'D',  'points' => 1.0],
            ['min_score' => 0,  'max_score' => 49, 'letter' => 'F',  'points' => 0.0],
        ]);
    }
}
