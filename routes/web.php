<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\RegistrationController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\TermController;
use App\Http\Controllers\Auth\StudentLoginController;

Route::get('/', function () {
    return view('welcome');
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

// 🔐 Routes خاصة بالإدارة (admin)
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {

    // إدارة المقررات
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

    // إدارة الترمات
    Route::get('/terms', [TermController::class, 'index'])->name('terms.index');
});
