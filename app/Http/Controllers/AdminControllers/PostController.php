<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Services\FileManagement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;

class PostController extends Controller
{
    public function index()
    {
        return Inertia::render('AdminDashboard/Posts/Index',[
            'posts' => Post::filter(
                request(['search', 'category', 'status','dateStart','dateEnd','sortBy']))
                ->paginate(10)->withQueryString(),
            'filters' => Request::only(['search', 'sortBy', 'category','status', 'dateStart', 'dateEnd'])
        ]);
    }
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
                path:'images/posts/'.$attributes['slug'].'/thumbnail'
            );
        }
        Post::create($attributes);
        return redirect('/admin-dashboard')->with('success','Post Created!');

    }

    public function edit(Post $post)
    {
        return Inertia::render('AdminDashboard/Posts/Edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);

    }

    public function update(Post $post, FileManagement $fileManagement)
    {
        // dd(request()->all());

        $attributes = $this->validatePost($post);

        if($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = 
            $fileManagement->uploadFile(
                file:$attributes['thumbnail'] ?? false,
                deleteOldFile: true, 
                oldFile: $post->thumbnail,
                path:'images/posts/'.($post['slug'] !== $attributes['slug'] ? $attributes['slug'] : $post['slug']).'/thumbnail',
            );  
        }
        // dd($attributes['thumbnail']);

        if($post['slug'] !== $attributes['slug']){
            $fileManagement->moveFiles(
                oldPath:'images/posts/'.$post['slug'].'/thumbnail',
                newPath:'images/posts/'.$attributes['slug'].'/thumbnail',
                deleteDirectory: 'images/posts/'.$post['slug']
            );
            $attributes['thumbnail'] = str_replace($post['slug'],$attributes['slug'],$post['thumbnail']);
        }

        $post->update($attributes);

        return back()->with('success', 'Post Updated!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        Storage::deleteDirectory('images/posts/'.$post['slug']);

        return redirect('/admin-dashboard/posts')->with('Success', 'User Deleted!');
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
