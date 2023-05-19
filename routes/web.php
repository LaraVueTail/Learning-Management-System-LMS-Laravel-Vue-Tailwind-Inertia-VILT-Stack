<?php

use App\Http\Controllers\AdminControllers\DashboardController;
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

Route::get('/', function () {
    return Inertia::render('Public/Home');
});
Route::prefix('/admin-dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'home']);
    Route::get('/team', [DashboardController::class, '']);

});
Route::get('/admin-dashboard/team', function () {
    return Inertia::render('AdminDashboard/Home');
});
