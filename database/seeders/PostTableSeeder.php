<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Interaction;
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
        $a->image = "https://api.lorem.space/image?w=150&h=180";
        $a->body = "Hello world... from the shadows";
        $a->profile_id = 1;
        $a->save();

        Post::factory()->has(Interaction::factory()->count(5))->count(5)->create();
    }
}
