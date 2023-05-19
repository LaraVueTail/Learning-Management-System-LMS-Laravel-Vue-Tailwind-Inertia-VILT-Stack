<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function home()
    {
        return Inertia::render('AdminDashboard/Home');
    }
}
