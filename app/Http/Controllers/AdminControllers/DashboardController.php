<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\TeacherController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function home()
    {
        return Inertia::render('AdminDashboard/Home');

    }

    public function profile_info()
    {
        return Inertia::render('AdminDashboard/ProfileInfo', [
            'teacher' => Auth::user(),
        ]);

    }

    public function update()
    {
        $teacher = Auth::user();
        $teacherController = new TeacherController();
        $teacherController->update($teacher);
        return redirect('/admin-dashboard')->with('success', 'Your account has been updated.');
    }
}
