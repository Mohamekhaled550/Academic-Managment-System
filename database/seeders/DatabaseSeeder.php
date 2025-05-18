<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\{Department, CourseGroup, Term, Course, CourseOffering, Prerequisite,Student};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('departments')->truncate();
        DB::table('course_groups')->truncate();
        DB::table('terms')->truncate();
        DB::table('courses')->truncate();
        DB::table('course_offerings')->truncate();
        DB::table('prerequisites')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Departments
        $departments = [
            'GEN' => 'General Science',
            'CS' => 'Computer Science',
            'IS' => 'Information Systems',
        ];

        foreach ($departments as $code => $name) {
            Department::create(['code' => $code, 'name' => $name]);
        }

        $deptIds = Department::pluck('id', 'code');

        // Course Groups
        $groups = [
            ['name' => 'General Courses', 'code' => 1],
            ['name' => 'Specialized Courses', 'code' => 2],
        ];

        foreach ($groups as $group) {
            CourseGroup::create($group);
        }

        $groupIds = CourseGroup::pluck('id', 'code');

          // إعداد بيانات الكورسات المرتبة حسب الترم
        $coursesByTerm = [
            // year => [semester => [courses]]
            1 => [
                'first' => [
                    ['Introduction to Computer Science', 'CS101', 'GEN', 3],
                    ['Mathematics 1', 'GEN101', 'GEN', 3],
                    ['Physics', 'GEN102', 'GEN', 3],
                    ['Introduction to Programming', 'CS102', 'CS', 3],
                    ['Mathematics 2', 'GEN103', 'GEN', 3],
                    ['Discrete Mathematics', 'CS103', 'CS', 3],
                ],
                'second' => [
                    ['Object-Oriented Programming', 'CS104', 'CS', 3],
                    ['Data Structures', 'CS105', 'CS', 3],
                    ['Cloud Computing', 'CS106', 'CS', 3],
                    ['Introduction to Networks', 'CS107', 'CS', 3],
                    ['Physics 2', 'GEN104', 'GEN', 3],
                    ['Statistics', 'GEN105', 'GEN', 3],
                ]
            ],
            2 => [
                'first' => [
                    ['Data Structures', 'CS201', 'CS', 3],
                    ['Object-Oriented Programming', 'CS202', 'CS', 3],
                    ['Database Systems', 'CS203', 'CS', 3],
                    ['Operating Systems', 'CS204', 'CS', 3],
                    ['Web Design', 'CS205', 'CS', 3],
                    ['Advanced Mathematics', 'GEN201', 'GEN', 3],
                ],
                'second' => [
                    ['Computer Networks', 'CS206', 'CS', 3],
                    ['Cybersecurity', 'CS207', 'CS', 3],
                    ['Algorithms', 'CS208', 'CS', 3],
                    ['Artificial Intelligence', 'CS209', 'CS', 3],
                    ['System Analysis and Design', 'CS210', 'CS', 3],
                    ['Technology Management', 'GEN202', 'GEN', 3],
                ],
            ],
            3 => [
                'first' => [
                    ['Software Engineering', 'CS301', 'CS', 3],
                    ['Artificial Intelligence 2', 'CS302', 'CS', 3],
                    ['Mobile Application Development', 'CS303', 'CS', 3],
                    ['Information Systems', 'CS304', 'IS', 3],
                    ['Data Management', 'CS305', 'IS', 3],
                    ['Programming Tools', 'CS306', 'CS', 3],
                ],
                'second' => [
                    ['Graduation Project 1', 'CS307', 'CS', 3, true],
                    ['Cloud Computing', 'CS308', 'CS', 3],
                    ['Big Data Analysis', 'CS309', 'CS', 3],
                    ['Information Security', 'CS310', 'CS', 3],
                    ['Digital Accounting', 'GEN303', 'GEN', 3],
                    ['Software Project Management', 'CS311', 'CS', 3],
                ]
            ],
            4 => [
                'first' => [
                    ['Graduation Project 2', 'CS401', 'CS', 3, true],
                    ['Big Data Analytics', 'CS402', 'CS', 3],
                    ['Network Security', 'CS403', 'CS', 3],
                    ['Machine Learning', 'CS404', 'CS', 3],
                    ['Advanced Programming', 'CS405', 'CS', 3],
                    ['Embedded Systems', 'CS406', 'CS', 3],
                ],
                'second' => [
                    ['Tech Business Management', 'CS407', 'IS', 3],
                    ['Ethical Hacking', 'CS408', 'CS', 3],
                    ['Parallel Computing', 'CS409', 'CS', 3],
                    ['Game Development', 'CS410', 'CS', 3],
                    ['Software Testing', 'CS411', 'CS', 3],
                    ['Final Graduation Project', 'CS412', 'CS', 3, true],
                ],
            ],
        ];

        $courseModels = [];

        // إنشاء الترمات وكل ترم يتم إلحاق كورساته مباشرة
        foreach ($coursesByTerm as $level => $semesters) {
            foreach ($semesters as $semester => $courses) {
                $term = Term::create([
                    'name' => "Year $level - " . ucfirst($semester) . " Term",
                    'year' => '2024/2025',
                    'semester' => $semester,
                    'level' => $level,
                    'is_active' => false,
                    'registration_start_date' => null,
                    'registration_end_date' => null,
                ]);

                foreach ($courses as $courseData) {
                    [$name, $code, $deptCode, $creditHours, $isProject] = array_pad($courseData, 5, false);

                    $course = Course::create([
                        'name' => $name,
                        'code' => $code,
                        'department_id' => $deptIds[$deptCode],
                        'course_group_id' => $groupIds[$deptCode === 'GEN' ? 1 : 2],
                        'level' => $level,
                        'credit_hours' => $creditHours,
                        'is_project' => $isProject,
                    ]);

                    CourseOffering::create([
                        'course_id' => $course->id,
                        'term_id' => $term->id,
                        'level' => $level,
                        'is_elective' => false,
                    ]);

                    $courseModels[$code] = $course;
                }
            }
        }



  // Prerequisites
        $prerequisites = [
            ['CS201', 'CS103'], // Data Structures → Discrete Math
            ['CS202', 'CS102'], // OOP → Intro to Programming
            ['CS203', 'CS201'], // DB Systems → Data Structures
            ['CS204', 'CS101'],
            ['CS205', 'CS204'],
            ['CS301', 'CS202'],
            ['CS302', 'CS202'],
            ['CS303', 'CS202'],
            ['CS304', 'CS204'],
            ['CS305', 'CS302'],
            ['CS306', 'CS201'],
            ['CS402', 'CS401'],
        ];

          foreach ($prerequisites as [$courseCode, $prereqCode]) {
            if (isset($courseModels[$courseCode], $courseModels[$prereqCode])) {
                Prerequisite::create([
                    'course_id' => $courseModels[$courseCode]->id,
                    'prerequisite_id' => $courseModels[$prereqCode]->id,
                ]);
            }
        }





          // Students
        foreach (range(1, 20) as $i) {
            Student::create([
                'name' => "Student $i",
                'department_id' => Department::inRandomOrder()->first()->id,
                'national_id' => '3000101010' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'email' => "student$i@example.com",
                'gpa' => rand(200, 400) / 100,
                'total_credits' => rand(0, 120),
                'status' => 'active',
                'level' => rand(1, 4)
            ]);
        }

    }
}
