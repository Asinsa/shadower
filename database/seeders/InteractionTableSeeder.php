<?php

namespace Database\Seeders;

use App\Models\Interaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InteractionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new Interaction;
        $a->profile_id = 1;
        $a->post_id = 1;
        $a->interaction_type = "comment";
        $a->comment = "hi there";
        $a->save();
    }
}
