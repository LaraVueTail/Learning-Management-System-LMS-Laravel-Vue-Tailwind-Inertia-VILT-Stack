<?php

namespace App\Policies;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeacherPolicy
{
    /**
     * Determine whether the user can view any models.
     */

    public function before(Teacher $teacher, string $ability): bool | null
    {
        if (Auth::guard('teacher')->user()->can('admin')) {
            return true;
        }
        return null;
    }

    public function viewAny(Teacher $teacher): bool
    {
        //
        return false;

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Teacher $user, Teacher $teacher): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Teacher $teacher): bool
    {
        //
        return false;

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Teacher $user, Teacher $teacher): bool
    {
        //
        return $user->id === $teacher->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Teacher $user, Teacher $teacher): bool
    {
        //
        return $user->id === $teacher->id;

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Teacher $user, Teacher $teacher): bool
    {
        //
        return $user->id === $teacher->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Teacher $user, Teacher $teacher): bool
    {
        //
        return $user->id === $teacher->id;
    }
}
