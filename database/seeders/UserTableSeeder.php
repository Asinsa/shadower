<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hardcoded User that errors cos new is created every time
        //$a = new User();
        //$a->name = "Shadow Shadow";
        //$a->email = "shadow@gmail.com";
        //$a->password = Hash::make('password');
        //$a->save();

        User::factory()->count(50)->create();
    }
}
