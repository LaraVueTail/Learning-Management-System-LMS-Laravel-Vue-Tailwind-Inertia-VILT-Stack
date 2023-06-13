<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use App\Services\FileManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ChapterController extends Controller
{
    //
    public function __construct()
    {
        $this->authorizeResource(Chapter::class, 'chapter');
    }

    public function index()
    {
        $fileteredChapters = Chapter::filter(
            request(['search', 'dateStart', 'dateEnd', 'sortBy', 'course']));
        $chapters = Auth::guard('teacher')->user()->can('admin') ? $fileteredChapters : $fileteredChapters->whereHas('course', function ($query) {
            $query->whereHas('teacher', function ($query) {
                $query->where('id', Auth::guard('teacher')->user()->id);
            });
        });

        $courses = Auth::guard('teacher')->user()->can('admin') ? Course::get(['name', 'slug'])
        : Course::whereBelongsTo(Auth::guard('teacher')->user())->get(['name', 'slug']);
        return Inertia::render('AdminDashboard/Chapters/Index', [
            'chapters' => $chapters
                ->with('course')->paginate(3)->withQueryString(),
            'filters' => Request::only(['search', 'sortBy', 'dateStart', 'dateEnd', 'course']),
            'courses' => $courses,
        ]);
    }

    public function show(Course $course, Chapter $chapter)
    {
        return Inertia::render('Public/Chapter/Show', [
            'chapter' => $chapter,
        ]);
    }

    public function create()
    {
        $courses = Auth::guard('teacher')->user()->can('admin') ? Course::get(['id', 'name'])
        : Course::whereBelongsTo(Auth::guard('teacher')->user())->get(['id', 'name']);
        return Inertia::render('AdminDashboard/Chapters/Create', [
            'courses' => $courses,
            'courseId' => request()->input('courseId'),
        ]);
    }

    public function store(FileManagement $fileManagement)
    {
        // dd(request()->all());
        $attributes = $this->validateChapter();
        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = $fileManagement->uploadFile(
                file:$attributes['thumbnail'],
                path:'images/chapters/' . $attributes['slug'] . '/thumbnail'
            );
        }
        Chapter::create($attributes);
        return redirect('/admin-dashboard/chapters')->with('success', 'Chapter Created!');
    }

    public function edit(Chapter $chapter)
    {
        $courses = Auth::guard('teacher')->user()->can('admin') ? Course::get(['id', 'name'])
        : Course::whereBelongsTo(Auth::guard('teacher')->user())->get(['id', 'name']);
        return Inertia::render('AdminDashboard/Chapters/Edit', [
            'chapter' => $chapter,
            'courses' => $courses,
        ]);

    }

    public function update(Chapter $chapter, FileManagement $fileManagement)
    {
        // dd(request()->all());

        $attributes = $this->validateChapter($chapter);

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] =
            $fileManagement->uploadFile(
                file:$attributes['thumbnail'] ?? false,
                deleteOldFile:true,
                oldFile:$chapter->thumbnail,
                path:'images/chapters/' . ($chapter['slug'] !== $attributes['slug'] ? $attributes['slug'] : $chapter['slug']) . '/thumbnail',
            );
        }
        // dd($attributes['thumbnail']);

        if ($chapter['slug'] !== $attributes['slug']) {
            $fileManagement->moveFiles(
                oldPath:'images/chapters/' . $chapter['slug'] . '/thumbnail',
                newPath:'images/chapters/' . $attributes['slug'] . '/thumbnail',
                deleteDirectory:'images/chapters/' . $chapter['slug']
            );
            $attributes['thumbnail'] = str_replace($chapter['slug'], $attributes['slug'], $chapter['thumbnail']);
        }

        $chapter->update($attributes);

        return back()->with('success', 'Chapter Updated!');
    }

    protected function validateChapter( ? Chapter $chapter = null) : array
    {
        $chapter ??= new Chapter();

        return request()->validate(
            [
                'name' => 'required|min:3|max:50',
                'description' => 'required|max:1000',
                'thumbnail' => $chapter->exists ? 'nullable' : 'required | mimes:jpeg,png | max:2096',
                'course_id' => ['required', Rule::exists('courses', 'id')],
                'slug' => ['required', Rule::unique('chapters', 'slug')->ignore($chapter)],
                'video' => 'required|max:200',

            ],
            [
                'slug' => 'Enter a unique slug for course link',
                'thumbnail' => 'Upload thumbnail e as jpg/png format with size less than 2MB',
            ]
        );
    }
}
