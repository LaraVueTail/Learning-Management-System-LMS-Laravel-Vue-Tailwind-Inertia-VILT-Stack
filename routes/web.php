<?php

use App\Http\Controllers\AdminControllers\DashboardController;
use App\Http\Controllers\AdminControllers\PostsController;
use App\Http\Controllers\PublicPagesController;
use App\Http\Controllers\UserController;
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
    Route::name('account.')->group(function(){
        Route::get('login', [UserController::class, 'login'])->middleware('guest')->name('login');
        Route::post('login', [UserController::class, 'auth'])->middleware('guest');
        Route::post('logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');
        Route::get('register', [UserController::class, 'create'])->middleware('guest')->name('register');
        Route::post('register', [UserController::class, 'store'])->middleware('guest');
    });
});

Route::name('admin.')->group(function(){
    Route::middleware(['auth','can:admin'])->group(function(){
        Route::prefix('/admin-dashboard')->group(function () {
            Route::get('/', [DashboardController::class, 'home'])->name('home');
            Route::resource('/posts', PostsController::class)->except('show');

        });
    });
});




Route::get('/admin-dashboard/team', function () {
    return Inertia::render('AdminDashboard/Home');
});
