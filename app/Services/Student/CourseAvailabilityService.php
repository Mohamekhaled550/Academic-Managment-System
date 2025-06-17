<?php

namespace App\Services\Student;

use App\Models\Student;
use App\Models\Term;

class CourseAvailabilityService
{
    protected TermService $termService;

    public function __construct(TermService $termService)
    {
        $this->termService = $termService;
    }

public function determineNextEligibleTerm(Student $student): ?Term
{

    // الطالب المستجد: أول تسجيل ليه
    if ($student->registrations()->count() === 0) {
        return Term::where('level', 1)
            ->where('is_active', true)
            ->first();
    }

    // لو الطالب عنده تسجيلات سابقة لكن معدل تراكمي غير كافي
    if ($student->gpa === null || $student->gpa < 2.0) {
        return null;
    }
  // نجيب آخر ترم سجله الطالب
    $lastTermId = $student->registrations()
        ->with('term')
        ->get()
        ->pluck('term.id')
        ->max();

    // نرجّع أول ترم فعّال بعده
    return Term::where('id', '>', $lastTermId)
        ->where('is_active', true)
        ->orderBy('id')
        ->first();
}


   public function getEligibleCoursesForTerm(Student $student, Term $term)
{
    $registeredCourseIds = $student->registrations()->pluck('course_id')->toArray();

    return $term->courseOfferings()
        ->with('course.prerequisites')
        ->get()
        ->pluck('course')
        ->filter(function ($course) use ($student, $registeredCourseIds) {
            // استبعاد المواد المسجلة مسبقاً
            if (in_array($course->id, $registeredCourseIds)) {
                return false;
            }

            // تحقق من المتطلبات السابقة
            foreach ($course->prerequisites as $prerequisite) {
                $hasPassed = $student->registrations()
                    ->where('course_id', $prerequisite->id)
                    ->where('grade', '>=', 50)
                    ->exists();


                if (!$hasPassed) {
                    return false;
                }
            }

            return true;
        })
        ->values();
}




}
