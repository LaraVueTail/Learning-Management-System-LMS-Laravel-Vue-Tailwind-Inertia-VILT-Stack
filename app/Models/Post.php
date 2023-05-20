<?php

namespace App\Models;

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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function thumbnailUrl():Attribute
    {
        return Attribute::make(
            get: fn($value) => asset($this->thumbnail ?? '')
        );
    }

    protected function link(): Attribute
    {
        return Attribute::make(
            get:fn($value) => asset('/posts/'.$this->slug)
        );
    }
}
