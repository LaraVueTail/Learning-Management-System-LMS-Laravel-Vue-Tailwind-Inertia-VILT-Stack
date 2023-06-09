<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request):  ? string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request) : array
    {
        $sharedData = array(
            'csrf_token' => csrf_token(),
            'app_url' => asset('/'),
            'is_student_logged' => Auth::guard('student')->check(),
            'is_teacher_logged' => Auth::guard('teacher')->check(),
            // 'admin' => [
            //     'email' => config('admin.email'),
            //     'name' => config('admin.name'),
            // ],
            'flash' => [
                'success' => fn() => $request->session()->get('success'),
            ]);
        return array_merge(parent::share($request), $sharedData);
    }
}
