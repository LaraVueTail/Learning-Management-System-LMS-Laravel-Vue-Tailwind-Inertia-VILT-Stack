<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class PublicPagesController extends Controller
{
    //
    public function homePage()
    {
        return Inertia::render('Public/Home');
    }

    public function aboutPage()
    {
        return Inertia::render('Public/About');
    }

    public function contactPage()
    {
        return Inertia::render('Public/Contact');
    }

    public function coursesPage()
    {
        return Inertia::render('Public/Courses', [
            'courses' => Course::filter(
                request(['search', 'dateStart', 'dateEnd', 'sortBy', 'teacher']))
                ->with('teacher')->paginate(6)->withQueryString(),
            'filters' => Request::only(['search', 'sortBy', 'dateStart', 'dateEnd', 'teacher']),
            'teachers' => Teacher::get(['first_name', 'last_name', 'slug']),
        ]);
    }
}
