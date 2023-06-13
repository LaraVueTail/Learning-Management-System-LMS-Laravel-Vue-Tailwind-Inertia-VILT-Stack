<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chapter extends Model
{
    use HasFactory;

    protected $appends = ['thumbnail_url', 'link'];

    public function scopeFilter($query, array $filters)
    {
        $query
            ->when(
                $filters['search'] ?? false, fn($query, $search) =>
                $query
                    ->where(fn($query) =>
                        $query
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%")
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

            ->when($filters['course'] ?? false, fn($query, $course) =>
                $query
                    ->whereHas('course', fn($query) =>
                        $query->whereIn('slug', json_decode($course))
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
            get:fn($value) => asset('/course/' . $this->course->slug . '/chapter/' . $this->slug)
        );
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
