<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Post;
use App\Models\Image;
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

        $b = new User();
        $b->name = "Jerry Smith";
        $b->email = "jerry@gmail.com";
        $b->password = Hash::make('password');
        $b->save();

        $p = new Profile();
        $p->username = "Jerry.Smith";
        $p->user_id = $b->id;
        $p->save();
        $image = new Image;
        $image->url = "https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/rick-and-morty-jerry-2-1624026834.jpeg?crop=0.563xw:1.00xh;0.254xw,0&resize=480:*";
        $p->image()->save($image);

        $post = new Post;
        $post->title = "Best Day Ever";
        $post->profile_id = $p->id;
        $post->save();
        $image = new Image;
        $image->url = "https://static.wikia.nocookie.net/rickandmorty/images/e/eb/Vlcsnap-2015-01-31-05h23m16s143.png";
        $post->image()->save($image);

        User::factory()->has(Profile::factory())->count(10)->create();
    }
}
