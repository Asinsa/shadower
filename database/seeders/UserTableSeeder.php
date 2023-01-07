<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
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
        // Hardcoded User
        $a = new User();
        $a->name = "Shadow Shadow";
        $a->email = "shadow@gmail.com";
        $a->password = Hash::make('password');
        $a->save();
        $a->roles()->attach(1); //Admin user

        User::factory()->has(Profile::factory())->count(10)->create();
    }
}
