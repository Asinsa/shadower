<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Interaction;
use App\Models\Post;
use App\Notifications\InteractionNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class Commenter extends Component
{
    public $post;
    public $newComment;

    protected $listeners = ['changed' => 'render'];

    public function addComment() {
        $comment = new Interaction;
        $comment->profile_id = Auth::user()->profile->id;
        $comment->post_id = $this->post->id;
        $comment->interaction_type = 'comment';
        $comment->comment = $this->newComment;
        $comment->save();

        // Notifying poster of post that is commented on
        $post = Post::findOrFail($comment->post_id);
        $commenter = Auth::user()->profile;
        $poster = $post->profile->user;
        $posterProfile = $post->profile;

        if (Auth::user()->id != $poster->id) {
            $interactionData = [
                'greeting' => "Hello $poster->name ($posterProfile->username)!",
                'body' => "$commenter->username has commented '$comment->comment' on your post '$post->title'",
                'type' => 'View Comment',
                'url' => url("/posts/$comment->post_id"),
                'thankyou' => 'Thank you for posting on Shadower'
            ];

            Notification::send($poster, new InteractionNotification($interactionData));
        }

        session()->flash('comment_message', 'Comment was successfully created!');

        $this->emit('changed');
    }

    public function DeleteComment($comm) {
        $comm = Interaction::findOrFail($comm);
        $comm->delete();

        $this->emit('changed');
    }

    public function render()
    {
        return view('livewire.commenter');
    }
}
