<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $appends = ['link'];


    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    protected function link(): Attribute
    {
        return Attribute::make(
        get: function($value) {
            $link = asset('').'posts?'.http_build_query(['category'=>json_encode([$this->slug])]);
            return $link;
    });
    }
}
