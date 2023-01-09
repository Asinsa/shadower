<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Interaction;
use App\Notifications\InteractionNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class Likes extends Component
{
    public $post;

    protected $listeners = ['changed' => 'render'];

    public function addLike() {
        $like = new Interaction;
        $like->profile_id = Auth::user()->profile->id;
        $like->post_id = $this->post->id;
        $like->interaction_type = 'like';
        $like->save();

        // Notifying poster of post that is liked
        $post = Post::findOrFail($like->post_id);
        $commenter = Auth::user()->profile;
        $poster = $post->profile->user;
        $posterProfile = $post->profile;

        if (Auth::user()->id != $poster->id) {
            $interactionData = [
                'greeting' => "Hello $poster->name ($posterProfile->username)!",
                'body' => "$commenter->username likes your post '$post->title'",
                'type' => 'View Post',
                'url' => url("/posts/$like->post_id"),
                'thankyou' => 'Thank you for posting on Shadower'
            ];

            Notification::send($poster, new InteractionNotification($interactionData));
        }

        session()->flash('message', 'Post Liked!');

        $this->emit('changed');
    }

    public function render()
    {
        return view('livewire.likes');
    }
}
