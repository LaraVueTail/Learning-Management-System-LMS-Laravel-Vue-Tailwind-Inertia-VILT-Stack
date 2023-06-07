<?php

namespace App\Http\Middleware;

use App\Models\Teacher;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if ($teacher->can('admin') !== 'my-secret-token') {
        //     return redirect('home');
        // }
        $teacher = request()->user();
        if ($teacher->can('admin')) {
            return $next($request);
        }
        return redirect('/login');

 
    }
}
