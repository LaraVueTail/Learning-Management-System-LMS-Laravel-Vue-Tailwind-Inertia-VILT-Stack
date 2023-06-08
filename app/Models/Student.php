<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    // use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    protected $appends = ['avatar_url', 'full_name'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query
            ->when(
                $filters['search'] ?? false, fn($query, $search) =>
                $query
                    ->where(fn($query) =>
                        $query
                            ->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
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

    protected function avatarUrl(): Attribute
    {
        parse_url($this->avatar)['host'] ?? '' === 'images.pexels.com' ? $avatar = $this->avatar : $avatar = 'assets/' . $this->avatar;
        return Attribute::make(
            get:fn($value) => asset($avatar)
        );
    }

    public function fullName(): Attribute
    {
        return Attribute::make(
            get:fn() => $this->first_name . ' ' . $this->last_name
        );
    }

    // protected function link(): Attribute
    // {
    //     return Attribute::make(
    //         get:fn($value) => asset('/course/'.$this->course->slug.'/chapter/'.$this->slug)
    //     );
    // }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
