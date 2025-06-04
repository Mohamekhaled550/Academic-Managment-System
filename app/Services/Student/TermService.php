<?php


namespace App\Services\Student;

use App\Models\Student;
use App\Models\Term;

class TermService
{
    public function determineNext(Student $student): ?Term
    {
        $lastTerm = $student->registrations()
                            ->latest('term_id')
                            ->with('term')
                            ->first()
                            ?->term;

        if ($lastTerm) {
            return Term::where(function ($q) use ($lastTerm) {
                        $q->where('year', '>', $lastTerm->year)
                          ->orWhere(function ($q2) use ($lastTerm) {
                              $q2->where('year', $lastTerm->year)
                                 ->where('semester', '>', $lastTerm->semester);
                          });
                    })
                    ->orderBy('year')
                    ->orderBy('semester')
                    ->first();
        }

        return Term::where('level', $student->level)
                    ->orderBy('year')
                    ->orderBy('semester')
                    ->first();
    }
}
