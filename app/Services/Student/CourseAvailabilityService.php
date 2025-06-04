<?php


namespace App\Services\Student;

use App\Models\Course;
use App\Models\Student;
use App\Models\Term;

class CourseAvailabilityService
{
    public function getAvailable(Student $student, Term $term): array
    {
        $passedCourses = $student->registrations()->where('grade', '>=', 50)->pluck('course_id')->toArray();
        $failedCourses = $student->registrations()->where('grade', '<', 50)->pluck('course_id')->toArray();

        $availableCourses = Course::whereHas('offerings', fn($q) => $q->where('term_id', $term->id))
            ->where(function ($query) use ($passedCourses) {
                $query->whereDoesntHave('prerequisites')
                      ->orWhereDoesntHave('prerequisites', function ($q) use ($passedCourses) {
                          $q->whereNotIn('prerequisite_id', $passedCourses);
                      });
            })
            ->whereDoesntHave('registrations', fn($q) => $q->where('student_id', $student->id)->where('term_id', $term->id))
            ->get();

        $failedCoursesList = Course::whereIn('id', $failedCourses)
            ->whereHas('offerings', fn($q) => $q->where('term_id', $term->id))
            ->get();

        return $availableCourses->merge($failedCoursesList)->unique('id')->values()->all();
    }
}
