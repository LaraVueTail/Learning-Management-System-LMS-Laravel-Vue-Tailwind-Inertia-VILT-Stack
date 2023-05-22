<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'email' => config('admin.email'),
            'name' => config('admin.name'),
            'password' => config('admin.password'),
        ]);

        // Category::factory(5)->create();
        Post::factory(5)->create();
    }
}
