<?php

namespace App\Policies;

use App\Models\Chapter;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class ChapterPolicy
{

    public function before($user, string $ability): bool|null
    {

        if (Auth::guard('teacher')->check() ? Auth::guard('teacher')->user()->can('admin') : false) {
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Teacher $teacher): bool
    {
        return $teacher->courses->count() > 0;

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Student $student, Chapter $chapter): bool
    {
        return $student->course_id === $chapter->course->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Teacher $teacher): bool
    {
        return $teacher->courses->count() > 0;

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Teacher $teacher, Chapter $chapter): bool
    {
        return $teacher->id === $chapter->course->teacher->id;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Teacher $teacher, Chapter $chapter): bool
    {
        return $teacher->id === $chapter->course->teacher->id;

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Teacher $teacher, Chapter $chapter): bool
    {
        return $teacher->id === $chapter->course->teacher->id;

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Teacher $teacher, Chapter $chapter): bool
    {
        return $teacher->id === $chapter->course->teacher->id;

    }
}