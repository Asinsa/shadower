<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class InteractionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'profile_id' => fake()->numberBetween(1, 51),
            'post_id' => fake()->numberBetween(1, 51),
            'interaction_type' => 'comment',
            'comment' => fake()->sentence(6, true),
        ];
    }
}
