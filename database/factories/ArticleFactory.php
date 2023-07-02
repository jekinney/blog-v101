<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => 1,
            'category_id' => 1,
            'title' => fake()->sentence(),
            'body' => fake()->paragraph(),
            'header_image' => fake()->imageUrl(1200, 330),
            'is_featured' => 0,
            'is_draft' => 0,
            'publish_at' => fake()->dateTimeBetween('-1 year', '-1 week'),
            'expires_at' => fake()->dateTimeBetween('+2 years', '+10 years'),
        ];
    }
}
