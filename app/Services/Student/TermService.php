<?php

namespace App\Services\Student;

use App\Models\Term;

class TermService
{
    public function getActiveTerm(): ?Term
    {
        return Term::where('is_active', true)->first();
    }

    public function isWithinRegistrationPeriod(Term $term): bool
    {
        $today = now();
        return $today->between($term->registration_start_date, $term->registration_end_date);
    }


    
}
