<?php

namespace App\Http\Controllers;

use App\Models\Interaction;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\Auth;

class InteractionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interactions = Interaction::get();
        return view('interactions.index', ['interactions' => $interactions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request['interaction_type'] == "comment") {
            $validatedData = $request->validate([
                'comment' => 'required|max:255',
                'post_id' => 'required',
            ]);

            $comment = new Interaction;
            $comment->profile_id = Auth::user()->profile->id;
            $comment->post_id = $validatedData['post_id'];
            $comment->interaction_type = 'comment';
            $comment->comment = $validatedData['comment'];
            $comment->save();

            session()->flash('comment_message', 'Comment was successfully created!');
            return redirect()->route('posts.show', ['id' => $validatedData['post_id']]);
        } 
        else {
            $like = new Interaction;
            $like->profile_id = Auth::user()->profile->id;
            $like->post_id = $request['post_id'];
            $like->interaction_type = 'like';
            $like->save();

            session()->flash('message', 'Post Liked!');
            if($request['redirect_to'] == "all") {
                return redirect()->route('posts.index');
            }
            return redirect()->route('posts.show', ['id' => $request['post_id']]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Interaction::findOrFail($id);
        return view('interactions.edit', ['interaction' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Interaction::findOrFail($id);

        $validatedData = $request->validate([
            'comment' => 'required|max:255',
        ]);

        $comment->comment = $validatedData['comment'];
        $comment->save();

        if ($comment->wasChanged()) {
            session()->flash('comment_message', 'Comment was successfully edited!');
        }

        return redirect()->route('posts.show', ['id' => $comment->post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Interaction::findOrFail($id);
        $post_id = $comment->post->id;
        $comment->delete();

        return redirect()->route('posts.show', ['id' => $post_id])->with('comment_message', 'Comment was successfully deleted');
    }
}
