<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\Auth\StudentLoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// صفحة تسجيل الدخول
Route::get('student/login', [StudentLoginController::class, 'showLoginForm'])->name('student.login');

// تنفيذ تسجيل الدخول
Route::post('student/login', [StudentLoginController::class, 'login'])->name('student.login.submit');

// تسجيل الخروج
Route::post('student/logout', [StudentLoginController::class, 'logout'])->name('student.logout');

Route::middleware(['auth:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/profile', [StudentController::class, 'profile'])->name('student.profile');
    Route::get('/student/status', [StudentController::class, 'status'])->name('student.status');

    Route::get('/register', [RegistrationController::class, 'availableCourses'])->name('student.register.show');
    Route::post('/register', [RegistrationController::class, 'register'])->name('student.register.store');
});



// Routes للإدارة
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/terms', [TermController::class, 'index'])->name('terms.index');
});
