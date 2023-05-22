<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'heading'=> $this->faker->sentence(),
            'sub_heading'=> $this->faker->sentence(),
            'slug' => $this->faker->unique()->slug(),
            'thumbnail' => $this->faker->randomElement(
                [
                'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg',
                'https://tailwindui.com/img/ecommerce-images/product-page-02-featured-product-shot.jpg',
                'https://tailwindui.com/img/ecommerce-images/product-page-02-tertiary-product-shot-02.jpg',
                'https://tailwindui.com/img/ecommerce-images/product-page-02-tertiary-product-shot-01.jpg'
            ]),
            'category_id'=>Category::factory(),
            'keywords'=>$this->faker->word(),
            'text_content'=>'<p>' . implode('</p><p>', $this->faker->paragraphs(6)) . '</p>',
            'status'=>$this->faker->randomElement(['published', 'draft']),

        ];
    }
}
