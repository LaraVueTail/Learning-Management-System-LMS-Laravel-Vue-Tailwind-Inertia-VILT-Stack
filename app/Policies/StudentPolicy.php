<?php

namespace App\Policies;

use App\Models\Student;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class StudentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function before($user, string $ability): bool | null
    {

        if (Auth::guard('teacher')->check() ?Auth::guard('teacher')->user()->can('admin') : false) {
            return true;
        }
        return null;
    }

    public function viewAny(Student $student): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Student $user, Student $student): bool
    {
        return false;

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Student $student): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Student $user, Student $student): bool
    {
        if($user->id === $student->id){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Student $user, Student $student): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Student $user, Student $student): bool
    {
        //
        return false;

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Student $user, Student $student): bool
    {
        //
        return false;

    }
}
