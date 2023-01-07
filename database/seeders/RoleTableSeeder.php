<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ["name" => "Admin"],
            ["name" => "Post Moderator"],
            ["name" => "Comment Moderator"],
            ["name" => "User"]
        ];

        Role::insert($roles);
    }
}
