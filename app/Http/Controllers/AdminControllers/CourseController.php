<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Teacher;
use App\Services\FileManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class CourseController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('AdminDashboard/Courses/Index', [
            'courses' => Course::filter(
                request(['search', 'dateStart', 'dateEnd', 'sortBy', 'teacher']))
                ->with('teacher')->paginate(3)->withQueryString(),
            'filters' => Request::only(['search', 'sortBy', 'dateStart', 'dateEnd', 'teacher']),
            'teachers' => Teacher::get(['first_name', 'last_name', 'slug']),
        ]);
    }

    public function show(Course $course)
    {
        return Inertia::render('Public/Course/Show', [
            'course' => $course,
            'enrolled' => ((Auth::guard('student')->user()->course_id ?? '') === $course->id),
            'firstChapter' => $course->chapters->first(),
            'chapters' => $course->chapters,
            'teacher' => $course->teacher,
        ]);
    }

    public function create()
    {
        return Inertia::render('AdminDashboard/Courses/Create', [
            'teachers' => Teacher::get(['id', 'first_name', 'last_name', 'email']),
        ]);
    }

    public function store(FileManagement $fileManagement)
    {
        // dd(request()->all());
        $attributes = $this->validateCourse();
        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = $fileManagement->uploadFile(
                file:$attributes['thumbnail'],
                path:'images/courses/' . $attributes['slug'] . '/thumbnail'
            );
        }
        Course::create($attributes);
        return redirect('/admin-dashboard/courses')->with('success', 'Course Created!');
    }

    public function edit(Course $course)
    {
        return Inertia::render('AdminDashboard/Courses/Edit', [
            'course' => $course,
            'chapters' => $course->chapters,
            'teachers' => Teacher::get(['id', 'first_name', 'last_name']),
        ]);

    }

    public function update(Course $course, FileManagement $fileManagement)
    {
        // dd(request()->all());

        $attributes = $this->validateCourse($course);

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] =
            $fileManagement->uploadFile(
                file:$attributes['thumbnail'] ?? false,
                deleteOldFile:true,
                oldFile:$course->thumbnail,
                path:'images/courses/' . ($course['slug'] !== $attributes['slug'] ? $attributes['slug'] : $course['slug']) . '/thumbnail',
            );
        }
        // dd($attributes['thumbnail']);

        if ($course['slug'] !== $attributes['slug']) {
            $fileManagement->moveFiles(
                oldPath:'images/courses/' . $course['slug'] . '/thumbnail',
                newPath:'images/courses/' . $attributes['slug'] . '/thumbnail',
                deleteDirectory:'images/courses/' . $course['slug']
            );
            $attributes['thumbnail'] = str_replace($course['slug'], $attributes['slug'], $course['thumbnail']);
        }

        $course->update($attributes);

        return back()->with('success', 'Course Updated!');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        Storage::deleteDirectory('images/courses/' . $course['slug']);

        return redirect('/admin-dashboard/courses')->with('success', 'Course Deleted!');
    }

    protected function validateCourse( ? Course $course = null) : array
    {
        $course ??= new Course();

        return request()->validate([
            'name' => 'required|min:3|max:50',
            'short_description' => 'required|max:350',
            'description' => 'required|max:1000',
            'thumbnail' => $course->exists ? 'nullable' : 'required | mimes:jpeg,png | max:2096',
            'teacher_id' => ['required', Rule::exists('teachers', 'id')],
            'slug' => ['required', Rule::unique('courses', 'slug')->ignore($course)],
        ],
            [
                'slug' => 'Enter a unique slug for course link',
                'thumbnail' => 'Upload thumbnail e as jpg/png format with size less than 2MB',
            ]
        );
    }
}
