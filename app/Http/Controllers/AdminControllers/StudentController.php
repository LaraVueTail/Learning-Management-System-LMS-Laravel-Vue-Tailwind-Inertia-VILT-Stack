<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
// use Illuminate\Http\Request;
use App\Services\FileManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;


class StudentController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('AdminDashboard/Students/Index', [
            'students' => User::filter(
                request(['search', 'dateStart', 'dateEnd', 'sortBy','course'])
            )
                ->with('course')->paginate(3)->withQueryString(),
            'filters' => Request::only(['search', 'sortBy', 'dateStart', 'dateEnd', 'course']),
            'courses' => Course::get(['name', 'slug'])
        ]);
    }

    public function create()
    {
        return Inertia::render('AdminDashboard/Students/Create', [
            'courses' => Course::get(['id', 'name'])
        ]);
    }

    public function store(FileManagement $fileManagement)
    {
        // dd('ss');
        $attributes = $this->validateStudent();
        if ($attributes['avatar'] ?? false) {
            $attributes['avatar'] = $fileManagement->uploadFile(
                file: $attributes['avatar'],
                path: 'images/users/students/' . $attributes['email'] . '/avatar'
            );
        }

        User::create($attributes);
        return redirect('/admin-dashboard/students')->with('success', 'Student has been created.');
    }

    public function edit(User $user)
    {
        return Inertia::render('AdminDashboard/Students/Edit', [
            'student' => $user,
            'courses' => Course::get(['id', 'name'])
        ]);

    }

    protected function validateStudent(?User $user = null): array
    {
        $user ??= new User();

        return request()->validate(
            [
                'first_name' => 'required|min:3|max:50',
                'last_name' => 'required|max:50',
                'avatar' => 'nullable|mimes:jpeg,png |max:2096',
                'dob' => 'required',
                'course_id' => 'nullable',
                'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user)],
                'password' => (request()->input('password') ?? false || !$user->exists) ? 'required|confirmed|min:6' : 'nullable',
                'tac' => 'required|accepted'
            ],
            [
                'dob' => 'Date of birth required',
                'phone_number'=>'Enter a valid Phone number with country code',
                'avatar' => 'Upload Profile image as jpg/png format with size less than 2MB',
                'tac' => 'Please agree to the Terms and Conditions!'
            ]
        );
    }
}
