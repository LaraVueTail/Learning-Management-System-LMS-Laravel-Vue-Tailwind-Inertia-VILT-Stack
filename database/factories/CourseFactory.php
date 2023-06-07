<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'short_description' => fake()->paragraph(),
            'thumbnail' => fake()->randomElement(['https://images.pexels.com/photos/5412436/pexels-photo-5412436.jpeg', 'https://images.pexels.com/photos/1366944/pexels-photo-1366944.jpeg', 'https://images.pexels.com/photos/1771338/pexels-photo-1771338.jpeg']),
            'description' => fake()->paragraph(3),
            'slug' => $this->faker->unique()->slug(),
            'teacher_id'=>Teacher::factory(),
        ];
    }
}