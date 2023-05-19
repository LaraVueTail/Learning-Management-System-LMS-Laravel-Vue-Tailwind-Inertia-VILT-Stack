<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostsController extends Controller
{
    public function create()
    {
        return Inertia::render('AdminDashboard/Posts/Create');
    }
}
