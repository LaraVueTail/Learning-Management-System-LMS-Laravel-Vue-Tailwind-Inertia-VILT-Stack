<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $appends = ['thumbnail_url', 'link'];

    // protected $with = ['chapters','teacher'];

    public function scopeFilter($query, array $filters)
    {
        $query
            ->when(
                $filters['search'] ?? false, fn($query, $search) =>
                $query
                    ->where(fn($query) =>
                        $query
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('short_description', 'like', "%{$search}%")
                            // ->orWhere('email', 'like', "%{$search}%")
                            // ->orWhere('keywords', 'like', "%{$search}%")
                            ->orWhere('id', '=', $search)
                    )
            )

            ->when($filters['dateStart'] ?? false, function ($query, $dateStart) {
                $dateStart = Carbon::createFromFormat('m/d/Y', $dateStart)->format('Y-m-d');
                $query
                    ->whereDate('created_at', '>=', $dateStart);
            }
            )

            ->when(
                $filters['dateEnd'] ?? false,
                function ($query, $dateEnd) {
                    $dateEnd = Carbon::createFromFormat('m/d/Y', $dateEnd)->format('Y-m-d');
                    $query
                        ->whereDate('created_at', '<=', $dateEnd);
                }
            )

            ->when($filters['teacher'] ?? false, fn($query, $teacher) =>
                $query
                    ->whereHas('teacher', fn($query) =>
                        $query->whereIn('slug', json_decode($teacher))
                    )
            )

            ->when(
                $filters['sortBy'] ?? 'default',
                function ($query, $sortBy) {

                    if ($sortBy === 'date-dsc') {
                        $query->latest();
                    }
                    if ($sortBy === 'date-asc') {
                        $query->oldest();
                    }
                    if ($sortBy === 'default') {
                        $query->latest();
                    }
                }
            );
    }

    protected function thumbnailUrl(): Attribute
    {
        parse_url($this->thumbnail)['host'] ?? '' === 'images.pexels.com' ? $thumbnail = $this->thumbnail : $thumbnail = 'assets/' . $this->thumbnail;
        return Attribute::make(
            get:fn($value) => asset($thumbnail)
        );
    }

    protected function link(): Attribute
    {
        return Attribute::make(
            get:fn($value) => asset('/courses/' . $this->slug)
        );
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }
    public static function boot()
    {
        parent::boot();
        self::deleting(function ($course) { // before delete() method call this
            $course->chapters()->each(function ($chapter) {
                $chapter->delete(); // <-- direct deletion
            });
        });
    }
}
