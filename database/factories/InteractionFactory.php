<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Profile;
use App\Models\Post;
use App\Models\Interaction;

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
        $profile_id = Profile::all()->random()->id;
        $post_id = Post::all()->random()->id;

        $value = (bool)random_int(0, 1);
        $type=null;
        $comment=null;
        if ($value) {
            if (Interaction::where('profile_id', $profile_id)->where('post_id', $post_id)->count() < 1) {
                $type = 'like';
            }
            else {
                $type = 'comment';
                $comment = fake()->sentence(6, true);
            }
        } else {
            $type = 'comment';
            $comment = fake()->bs();
        }

        return [
            'profile_id' => $profile_id,
            'post_id' => $post_id,
            'interaction_type' => $type,
            'comment' => $comment,
        ];
    }
}
