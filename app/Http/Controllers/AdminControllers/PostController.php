<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Services\FileManagement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class PostController extends Controller
{
    public function create()
    {
        return Inertia::render('AdminDashboard/Posts/Create',[
            'categories' => Category::all()
        ]);
    }
    public function store(FileManagement $fileManagement)
    {
        // dd(request()->all());
        $attributes = $this->validatePost();
        if($attributes['thumbnail'] ?? false){
            $attributes['thumbnail'] = $fileManagement->uploadFile(
                file:$attributes['thumbnail'],
                path:'images/posts.'.$attributes['slug'].'/thumbnail'
            );
        }
        Post::create($attributes);
        return redirect('/admin-dashboard')->with('success','Post Created!');

    }

    public function validatePost(?Post $post = null):array
    {
        $post ??=new Post();
        return request()->validate([
            'heading' => 'required | max:255',
            'sub_heading' => 'required | max:255',
            'slug' => ['required',Rule::unique('posts','slug')->ignore($post)],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'thumbnail' => $post->exists ? 'nullable|mimes:jpeg,png |max:2096' : 'required|mimes:jpeg,png |max:2096',
            'keywords' => 'required | max:255',
            'text_content' => 'required | max:2000',
            'status' => ['required' , Rule::in(['published', 'draft'])],
        ]);
    }
}
