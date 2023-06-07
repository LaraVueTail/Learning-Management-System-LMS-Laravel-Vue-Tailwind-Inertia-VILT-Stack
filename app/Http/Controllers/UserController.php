<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\FileManagement;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function login()
    {
        return Inertia::render('Auth/Login');
    }

    public function auth(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($attributes)) {
            $request->session()->regenerate();
            $user = Auth::getProvider()->retrieveByCredentials($attributes);
            Auth::login($user, $request->get('remember'));
            return redirect()->intended('student-dashboard')->with('success', 'You are logged-in');
        } else if (Auth::guard('teacher')->attempt($attributes)) {
            $request->session()->regenerate();
            $teacher = Auth::guard('teacher')->user();
            Auth::login($teacher, $request->get('remember'));
            if ($teacher->can('admin')) {
                return redirect()->intended('admin-dashboard')->with('success', 'You are logged-in');
            }
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.'
            ])->onlyInput('email');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    public function store(FileManagement $fileManagement)
    {
        // dd('ss');
        $attributes = $this->validateUser();
        if ($attributes['avatar'] ?? false) {
            $attributes['avatar'] = $fileManagement->uploadFile(
                file: $attributes['avatar'],
                path: 'images/users/students/' . $attributes['email'] . '/avatar'
            );
        }

        User::create($attributes);
        Auth::login(User::create($attributes));
        return redirect('/')->with('success', 'Your account has been created.');
    }

    protected function validateUser(?User $user = null): array
    {
        $user ??= new User();

        return request()->validate(
            [
                'first_name' => 'required|min:3|max:50',
                'last_name' => 'required|max:50',
                'avatar' => 'nullable|mimes:jpeg,png |max:2096',
                'dob' => 'required',
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