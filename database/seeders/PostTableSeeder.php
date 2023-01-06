<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Interaction;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hardcoded Post
        $a = new Post;
        $a->title = "Hello";
        $a->body = "Hello world... from the shadows";
        $a->profile_id = 1;
        $a->save();
        
        $image = new Image;
        $image->url = fake()->imageUrl(1920, 1080);
        $a->image()->save($image);

        Post::factory()->has(Interaction::factory()->count(5))->count(5)->create();

        
        $posts = Post::all();
        foreach ($posts as $post) {
            $value = (bool)random_int(0, 1);
            if ($value) {
                $image = new Image;
                $image->url = fake()->imageUrl(1920, 1080);
                $post->image()->save($image);
                $post->save();
            }
        }
    }
}
