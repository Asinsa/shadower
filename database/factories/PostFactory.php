<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'title' => fake()->sentence(6, true),
            'image' => fake()->imageUrl(640, 800),
            'body' => fake()->text(200),
            'profile_id' => fake()->numberBetween(1, 51),
        ];
    }
}
