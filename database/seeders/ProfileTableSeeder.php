<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Post;
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
        $a->profile_pic = "https://api.lorem.space/image/face?w=150&h=150";
        $a->user_id = 1;
        $a->save();

        Profile::factory()->has(Post::factory()->count(5))->count(5)->create();
    }
}
