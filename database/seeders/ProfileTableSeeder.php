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
        $image->url = "https://api.lorem.space/image/face?w=150&h=150";
        $a->image()->save($image);


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
