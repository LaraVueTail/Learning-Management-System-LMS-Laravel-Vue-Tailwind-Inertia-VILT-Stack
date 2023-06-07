<?php

namespace App\Models;
use Illuminate\Auth\CreatesUserProviders;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;  

class Teacher extends Authenticatable
{
    use HasFactory;
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $appends = ['avatar_url','link','full_name'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // protected $with = ['course'];


    public function scopeFilter($query, array $filters)
    {
        $query
        ->when(
            $filters['search'] ?? false,fn($query, $search) =>
            $query
                ->where(fn($query) =>
                $query
                    ->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                                // ->orWhere('keywords', 'like', "%{$search}%")
                                //     ->orWhere('id', '=', $search)
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

    public function fullName(): Attribute
    {
        return Attribute::make(
            get:fn() => $this->first_name .' '.$this->last_name
        );
    }

    
    protected function avatarUrl():Attribute
    {   
        parse_url($this->avatar)['host'] ?? '' === 'images.pexels.com' ? $avatar = $this->avatar : $avatar = 'assets/'.$this->avatar ;
        return Attribute::make(
            get: fn($value) => asset($avatar)
        );
    }

    protected function link(): Attribute
    {
        return Attribute::make(
            get:fn($value) => asset('/teachers/'.$this->slug)
        );
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
    
    public static function boot() {
        parent::boot();
        self::deleting(function($teacher) { // before delete() method call this
             $teacher->courses()->each(function($course) {
                $course->teacher_id = 1;
                $course->save(); // <-- direct deletion
             });
             // do the rest of the cleanup...
        });
    }
}
