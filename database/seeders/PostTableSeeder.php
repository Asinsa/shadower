<?php

namespace Database\Seeders;

use App\Models\Post;
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
        $a = new Post;
        $a->title = "Hello";
        $a->image = "https://via.placeholder.com/640x640.png/000000?text=hello";
        $a->body = "Hello world... from the shadows";
        $a->profile_id = 1;
        $a->save();

        Post::factory()->count(50)->create();
    }
}
