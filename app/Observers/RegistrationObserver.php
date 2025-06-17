<?php

namespace App\Observers;

use App\Models\Registration;
use App\Models\Course;
use App\Services\Student\StudentProgressService;
use Illuminate\Support\Facades\Log;

class RegistrationObserver
{
    public function updated(Registration $registration)
    {
           if ($registration->isDirty('grade')) {
        app(StudentProgressService::class)->updateProgress($registration->student);
    }
    }
}
