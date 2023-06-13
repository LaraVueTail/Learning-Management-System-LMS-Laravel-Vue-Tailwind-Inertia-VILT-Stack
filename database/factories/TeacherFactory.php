<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'avatar' => fake()->randomElement(['https://images.pexels.com/photos/8617727/pexels-photo-8617727.jpeg', 'https://images.pexels.com/photos/5212320/pexels-photo-5212320.jpeg', 'https://images.pexels.com/photos/8617946/pexels-photo-8617946.jpeg']),
            'dob' => fake()->date('d-m-Y'),
            'designation' => fake()->randomElement(['M.Sc(Physics), M.Ed', 'PhD(Chemistry)', 'MD(Surgeon),MBBS']),
            'phone_number' => '+911234121221',
            'slug' => $this->faker->unique()->slug(),
            'is_admin' => 0,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }
}
