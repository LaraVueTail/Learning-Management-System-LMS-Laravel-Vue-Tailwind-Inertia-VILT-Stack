<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
