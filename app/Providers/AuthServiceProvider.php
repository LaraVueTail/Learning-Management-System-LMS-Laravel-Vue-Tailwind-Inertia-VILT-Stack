<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Policies\ChapterPolicy;
use App\Policies\TeacherPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        Chapter::class => ChapterPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('admin', [TeacherPolicy::class, 'admin']);
        // Gate::define('is_enrolled', [ChapterPolicy::class, 'view']);
    }
}
