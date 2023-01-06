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
        // Hardcoded Interaction
        $a = new Interaction;
        $a->profile_id = 1;
        $a->post_id = 1;
        $a->interaction_type = "comment";
        $a->comment = "hi there";
        $a->save();

        $b = new Interaction;
        $b->profile_id = 1;
        $b->post_id = 1;
        $b->interaction_type = "like";
        $b->save();

        Interaction::factory()->count(50)->create();
    }
}
