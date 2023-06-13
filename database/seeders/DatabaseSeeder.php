<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Chapter;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Teacher::factory()->create([
            'email' => config('admin.email'),
            'first_name' => config('admin.first_name'),
            'last_name' => config('admin.last_name'),
            'is_admin' => 1,
            'password' => config('admin.password'),
        ]);

        Teacher::factory()->create([
            'email' => 'teacher@example.com',
        ]);

        // User::factory(20)->create();

        // Course::factory(5)->create();
        Chapter::factory(10)->create();
        Student::factory(1)->create([
            'email' => 'student@example.com',
        ]);

        // Category::factory(5)->create();
        // Post::factory(5)->create();
    }
}
