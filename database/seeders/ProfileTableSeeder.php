<?php

namespace Database\Seeders;

use App\Models\Profile;
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
        $a->profile_pic = "https://www.pexels.com/photo/horses-on-water-13664663/";
        $a->user_id = 1;
        $a->save();

        Profile::factory()->count(50)->create();
    }
}
