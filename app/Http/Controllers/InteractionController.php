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

        session()->flash('message', 'Comment was successfully created!');
        return redirect()->route('posts.show', ['id' => $validatedData['post_id']]);
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
        //
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
        //
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

        return redirect()->route('posts.show', ['id' => $post_id])->with('message', 'Comment was successfully deleted');
    }
}
