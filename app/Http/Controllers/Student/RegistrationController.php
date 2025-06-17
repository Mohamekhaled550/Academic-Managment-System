<?php


namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Term;
use App\Services\Student\StudentProgressService;
use App\Services\Student\TermService;
use App\Services\Student\RegistrationService;
use App\Services\Student\CourseAvailabilityService;
use App\Services\Student\CreditHourService;
use App\Services\Student\StudentLevelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    protected $termService;
    protected $courseAvailabilityService;
    protected $creditHourService;
    protected $registrationService;
    protected $studentLevelService;
    protected $studentProgressService;

    public function __construct(
        TermService $termService,
        CourseAvailabilityService $courseAvailabilityService,
        CreditHourService $creditHourService,
        RegistrationService $registrationService,
        StudentLevelService $studentLevelService,
        StudentProgressService $studentProgressService,
    ) {
        $this->courseAvailabilityService = $courseAvailabilityService;
        $this->creditHourService = $creditHourService;
        $this->registrationService = $registrationService;
        $this->studentLevelService = $studentLevelService;
        $this->studentProgressService = $studentProgressService;
    }

    public function availableCourses()
    {

        $student = Auth::user();

        $term = $this->courseAvailabilityService->determineNextEligibleTerm($student);


        if (!$term/* || !$this->termService->isWithinRegistrationPeriod($term)*/) {
            return redirect()->back()->with('error', 'لا يوجد ترم متاح للتسجيل حالياً.');

        }

        $availableCourses = $this->courseAvailabilityService->getEligibleCoursesForTerm($student, $term);
        [$minHours, $maxHours] = $this->creditHourService->getMinMaxHours($student);

        return view('student.register', compact('term', 'availableCourses', 'minHours', 'maxHours'));
    }

    public function register(Request $request)
    {
        $student = Auth::user();

    $term = $this->courseAvailabilityService->determineNextEligibleTerm($student);


        if (!$term /*|| !$this->termService->isWithinRegistrationPeriod($term)*/) {
            return redirect()->back()->with('error', 'فترة التسجيل غير متاحة حالياً.');
        }

        $courseIds = $request->input('courses', []);
        [$minHours, $maxHours] = $this->creditHourService->getMinMaxHours($student);

        $this->registrationService->validateRegistration($student, $term, $courseIds, $minHours, $maxHours);
        $this->registrationService->registerCourses($student, $term, $courseIds);

        $this->studentLevelService->updateStudentLevel($student);
        $this->studentProgressService->updateProgress($student);
return redirect()->route('student.dashboard')->with('success', 'تم تسجيل المواد بنجاح.');
    }
}
