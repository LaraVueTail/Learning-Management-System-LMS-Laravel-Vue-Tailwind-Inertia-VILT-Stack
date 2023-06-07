<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Services\FileManagement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;


class TeacherController extends Controller
{
    public function index()
    {
        return Inertia::render('AdminDashboard/Teachers/Index',[
            'teachers' => Teacher::filter(
                request(['search','dateStart','dateEnd','sortBy']))
                ->paginate(3)->withQueryString(),
            'filters' => Request::only(['search', 'sortBy', 'dateStart', 'dateEnd'])
        ]);
    }
    //
    public function create()
    {
        return Inertia::render('AdminDashboard/Teachers/Create',[
            // 'categories' => Category::all()
        ]);
    }
    public function store(FileManagement $fileManagement)
    {
        // dd(request()->all());
        $attributes = $this->validateTeacher();
        if($attributes['avatar'] ?? false){
            $attributes['avatar'] = $fileManagement->uploadFile(
                file:$attributes['avatar'],
                path:'images/users/teachers/'.$attributes['slug'].'/avatar'
            );
        }
        Teacher::create($attributes);
        return redirect('/admin-dashboard/teachers')->with('success','Teacher Created!');
    }

    public function edit(Teacher $teacher)
    {
        return Inertia::render('AdminDashboard/Teachers/Edit', [
            'teacher' => $teacher
        ]);

    }

    public function update(Teacher $teacher, FileManagement $fileManagement)
    {
        // dd(request()->all());

        $attributes = $this->validateTeacher($teacher);

        if($attributes['avatar'] ?? false) {
            $attributes['avatar'] = 
            $fileManagement->uploadFile(
                file:$attributes['avatar'] ?? false,
                deleteOldFile: true, 
                oldFile: $teacher->avatar,
                path:'images/users/teachers/'.($teacher['slug'] !== $attributes['slug'] ? $attributes['slug'] : $teacher['slug']).'/avatar',
            );  
        }
        // dd($attributes['avatar']);

        if($teacher['slug'] !== $attributes['slug']){
            $fileManagement->moveFiles(
                oldPath:'images/users/teachers/'.$teacher['slug'].'/avatar',
                newPath:'images/users/teachers/'.$attributes['slug'].'/avatar',
                deleteDirectory: 'images/users/teachers/'.$teacher['slug']
            );
            $attributes['avatar'] = str_replace($teacher['slug'],$attributes['slug'],$teacher['avatar']);
        }

        $teacher->update($attributes);

        return back()->with('success', 'Teacher Updated!');
    }

    public function destroy(Teacher $teacher)
    {
        // dd($teacher->course->all());
        $teacher->delete();
        Storage::deleteDirectory('images/users/teachers/'.$teacher['slug']);

        return redirect('/admin-dashboard/teachers')->with('success', 'Teacher Deleted!');
    }


    protected function validateTeacher(?Teacher $teacher = null): array
    {
        $teacher ??= new Teacher();

        return request()->validate([
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|max:50',
            'avatar' => $teacher->exists ? 'nullable' : 'required | mimes:jpeg,png | max:2096',
            'dob' => 'required',
            'slug' => ['required',Rule::unique('teachers','slug')->ignore($teacher)],
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => ['required','email', Rule::unique('teachers', 'email')->ignore($teacher)],
            'is_admin' => 'nullable | boolean',
            'password' => (request()->input('password') ?? false || !$teacher->exists ) ? 'required|confirmed|min:6': 'nullable',
        ],
        [
            'dob' => 'Date of birth required',
            'slug'=> 'Enter a unique slug for your profile link',
            'phone_number'=>'Enter a valid Phone number with country code',
            'avatar' => 'Upload Profile image as jpg/png format with size less than 2MB',
        ]
    );
    }
}
