<?php

use App\Http\Controllers\AdminControllers\ChapterController;
use App\Http\Controllers\AdminControllers\CourseController;
use App\Http\Controllers\AdminControllers\DashboardController;
use App\Http\Controllers\AdminControllers\StudentController;
use App\Http\Controllers\AdminControllers\TeacherController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicPagesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::name('public.')->group(function () {
    Route::get('/', [PublicPagesController::class, 'homePage'])->name('home');
    Route::get('/about', [PublicPagesController::class, 'aboutPage'])->name('about');
    Route::get('/contact', [PublicPagesController::class, 'contactPage'])->name('contact');
    Route::get('/courses', [PublicPagesController::class, 'coursesPage'])->name('courses.index');
    Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('course.show');
    Route::post('/courses/{course:slug}/enroll', [StudentController::class, 'enroll'])->middleware('auth:student')->name('enroll');
    Route::get('/course/{course:slug}/chapter/{chapter:slug}', [ChapterController::class, 'show'])->middleware(['can:view,chapter', 'auth:student,teacher'])->name('chapter.show');
    Route::name('account.')->group(function () {
        Route::get('login', [AuthController::class, 'login'])->middleware('guest:student,teacher')->name('login');
        Route::post('login', [AuthController::class, 'auth'])->middleware('guest:student,teacher');
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:student,teacher')->name('logout');
        Route::get('register', [AuthController::class, 'register'])->middleware('guest:student,teacher')->name('register');
        Route::post('register', [AuthController::class, 'store'])->middleware('guest:student,teacher');
        Route::get('dashboard', [StudentController::class, 'studentDashboard'])->middleware('auth:student')->name('dashboard');
        Route::put('dashboard/{student}', [StudentController::class, 'update'])->middleware('auth:student')->name('dashboard');
    });
});

Route::name('admin.')->group(function () {
    Route::middleware('auth:teacher')->group(function () {
        Route::prefix('/admin-dashboard')->group(function () {
            Route::resource('/teachers', TeacherController::class)->except('show');
            Route::resource('/courses', CourseController::class)->except('show');
            Route::resource('/chapters', ChapterController::class)->except('show');
            Route::resource('/students', StudentController::class)->except('show');
            Route::get('/', [DashboardController::class, 'home'])->name('home');
            Route::get('/profile-info', [DashboardController::class, 'profile_info'])->name('profile_info');
            Route::put('/profile-info', [DashboardController::class, 'update'])->name('profile_info_update');
        });
    });
});

Route::get('/admin-dashboard/team', function () {
    return Inertia::render('AdminDashboard/Home');
});
