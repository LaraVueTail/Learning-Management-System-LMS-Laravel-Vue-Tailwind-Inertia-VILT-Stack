<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // dd($guards);
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // dd($guard);
            if (Auth::guard($guard)->check() && ($guard === 'web')) {
                return redirect()->route('admin.home');
            }
            if (Auth::guard($guard)->check() && ($guard === 'teacher')) {

                return redirect()->route('student.home');
            }
        }

        return $next($request);
    }
}
