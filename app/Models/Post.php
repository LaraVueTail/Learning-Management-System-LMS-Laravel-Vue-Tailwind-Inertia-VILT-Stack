<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $with = ['category'];

    protected $appends = ['thumbnail_url','link'];

    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        $query
        ->when(
            $filters['search'] ?? false,fn($query, $search) =>
            $query
                ->where(fn($query) =>
                $query
                    ->where('heading', 'like', "%{$search}%")
                        ->orWhere('sub_heading', 'like', "%{$search}%")
                            ->orWhere('text_content', 'like', "%{$search}%")
                                ->orWhere('keywords', 'like', "%{$search}%")
                                    ->orWhere('id', '=', $search)
            )
            )
                                            
        ->when(
            $filters['category'] ?? false, fn($query, $categories) =>
                    $query
                        ->whereHas(
                            'category', fn($query) =>
                            $query
                                ->whereIn('slug', json_decode($categories))
                    )
                    )

        ->when($filters['status'] ?? false, fn($query, $status) =>
            $query
                ->whereIn('status', json_decode($status))
        
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function thumbnailUrl():Attribute
    {   
        parse_url($this->thumbnail)['host'] ?? '' === 'images.pexels.com' ? $thumbnail = $this->thumbnail : $thumbnail = 'assets/'.$this->thumbnail ;
        return Attribute::make(
            get: fn($value) => asset($thumbnail)
        );
    }

    protected function link(): Attribute
    {
        return Attribute::make(
            get:fn($value) => asset('/posts/'.$this->slug)
        );
    }
}
