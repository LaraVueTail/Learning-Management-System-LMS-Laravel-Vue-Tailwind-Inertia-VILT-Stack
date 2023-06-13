<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class CoursePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Teacher $teacher): bool
    {
        //
        return Auth::guard('teacher')->user()->can('admin') || Auth::guard('teacher')->user()->courses->count() > 0;

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view( ? Student $student = null, Course $course) : bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Teacher $teacher): bool
    {
        //
        return Auth::guard('teacher')->user()->can('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Teacher $teacher, Course $course): bool
    {
        //
        return Auth::guard('teacher')->user()->can('admin') || Auth::guard('teacher')->user()->id === $course->teacher->id;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Teacher $teacher, Course $course): bool
    {
        return Auth::guard('teacher')->user()->can('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Teacher $teacher, Course $course): bool
    {
        return Auth::guard('teacher')->user()->can('admin');

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Teacher $teacher, Course $course): bool
    {
        return Auth::guard('teacher')->user()->can('admin');

    }
}
