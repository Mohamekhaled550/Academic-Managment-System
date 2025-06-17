<?php

namespace App\Services\Student;

use App\Models\Student;
use App\Models\Term;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RegistrationService
{
    public function validateRegistration(Student $student, Term $term, array $courseIds, int $minHours, int $maxHours): void
    {
        $courses = $term->courses()->whereIn('courses.id', $courseIds)->get();
        $totalHours = $courses->sum('credit_hours');

        if ($totalHours < $minHours || $totalHours > $maxHours) {
            throw ValidationException::withMessages([
                'courses' => "يجب أن يكون عدد الساعات بين {$minHours} و {$maxHours}."
            ]);
        }

        foreach ($courses as $course) {
if ($this->isAlreadyRegistered($student, $term, $course->id)) {
                throw ValidationException::withMessages([
                    'courses' => "لا يمكنك التسجيل في المقرر: {$course->name}."
                ]);
            }
        }
    }

    protected function isAlreadyRegistered(Student $student, Term $term, int $courseId): bool
{
    return $student->registrations()
        ->where('course_id', $courseId)
        ->where('term_id', $term->id)
        ->exists();
}



    public function registerCourses(Student $student, Term $term, array $courseIds): void
    {
        DB::transaction(function () use ($student, $term, $courseIds) {
            foreach ($courseIds as $courseId) {
                $student->registrations()->create([
                    'term_id' => $term->id,
                    'course_id' => $courseId,
                ]);
            }
        });
    }
}
