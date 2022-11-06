<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Profile;
use App\Models\Post;

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
            'profile_id' => Profile::all()->random()->id,
            'post_id' => Post::all()->random()->id,
            'interaction_type' => 'comment',
            'comment' => fake()->sentence(6, true),
        ];
    }
}
