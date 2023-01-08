<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Post;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hardcoded Profile
        $a = new Profile();
        $a->username = "Shadow";
        $a->user_id = 1;
        $a->save();
        $image = new Image;
        $image->url = "https://images.photowall.com/products/74785/black-dragon-at-beach.jpg?h=699&q=85";
        $a->image()->save($image);

        $post = new Post;
        $post->title = "Best Day Ever";
        $post->profile_id = $a->id;
        $post->save();
        $image = new Image;
        $image->url = "https://twinfinite.net/wp-content/uploads/2022/11/Shadow-the-Hedgehog-Key-Art-from-Sonic-Forces.jpg?fit=1200%2C675";
        $post->image()->save($image);

        Profile::factory()->has(Post::factory()->count(5))->count(5)->create();

        $profiles = Profile::all();
        foreach ($profiles as $profile) {
            $image = new Image;
            $image->url = fake()->imageUrl(640, 640);
            $profile->image()->save($image);
            $profile->save();
        }
    }
}
