<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Inertia\Inertia;

class PublicPagesController extends Controller
{
    //
    public function homePage()
    {
        return Inertia::render('Public/Home',[
            'posts' => Post::paginate(10)
        ]);
    }
}