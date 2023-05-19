<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

class PublicPagesController extends Controller
{
    //
    public function homePage()
    {
        return Inertia::render('Public/Home');
    }
}