<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\RegistrationController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\TermController;
use App\Http\Controllers\Admin\CourseGroupController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CourseRegistrationController;
use App\Http\Controllers\Admin\CourseOfferingController;
use App\Http\Controllers\Admin\PrerequisiteController;
use App\Http\Controllers\Auth\StudentLoginController;



Route::get('/', function () {
    return redirect()->route('admin.login');
});

// صفحات تسجيل دخول الطلاب
Route::get('student/login', [StudentLoginController::class, 'showLoginForm'])->name('student.login');
Route::post('student/login', [StudentLoginController::class, 'login'])->name('student.login.submit');
Route::post('student/logout', [StudentLoginController::class, 'logout'])->name('student.logout');

// 🔒 Routes خاصة بالطالب بعد تسجيل الدخول
Route::middleware(['auth:student'])->prefix('student')->name('student.')->group(function () {

    // لوحة التحكم
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // الملف الشخصي
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

    // عرض المواد المتاحة والتسجيل
    Route::get('/register', [RegistrationController::class, 'availableCourses'])->name('register.show');
    Route::post('/register', [RegistrationController::class, 'register'])->name('register.store');
});



// ----------------------
// Login Routes
Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Protected Routes
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('/admins', AdminController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::resource('/courses', CourseController::class);
    Route::resource('/departments', DepartmentController::class);
    Route::resource('/course-groups', CourseGroupController::class);
    Route::resource('/terms', TermController::class);
    Route::resource('/students', StudentController::class);
    Route::resource('/registrations',  CourseRegistrationController::class);
    Route::resource('/course-groups', CourseGroupController::class);
    Route::resource('/offerings', CourseOfferingController::class);
    Route::resource('/prerequisites', PrerequisiteController::class);

});
