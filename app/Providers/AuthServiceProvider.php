<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Course;
use App\Models\Teacher;
use App\Policies\ChapterPolicy;
use App\Policies\CoursePolicy;
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
        Teacher::class => TeacherPolicy::class,
        Course::class => CoursePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('admin', function (Teacher $teacher) {
            return $teacher->is_admin === 1;
        });
    }
}
