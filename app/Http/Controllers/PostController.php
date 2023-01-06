<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
            'title' => 'required|max:255',
            'image' => 'nullable|url|max:2048',
            'body' => 'nullable|max:2000',
        ]);

        $post = new Post;
        $post->title = $validatedData['title'];
        $post->image = $validatedData['image'];
        $post->body = $validatedData['body'];
        $post->profile_id = Auth::user()->profile->id;
        $post->save();

        session()->flash('message', 'Post was successfully created!');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
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
        $post = Post::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'image' => 'nullable|url|max:2048',
            'body' => 'nullable|max:2000',
        ]);

        $post->title = $validatedData['title'];
        $post->image = $validatedData['image'];
        $post->body = $validatedData['body'];
        $post->profile_id = Auth::user()->profile->id;
        $post->save();

        if ($post->wasChanged()) {
            session()->flash('post_message', 'Post was successfully edited!');
        }
        return redirect()->route('posts.show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $profile_id = $post->profile->id;
        $post->delete();

        return redirect()->route('profiles.show', ['id' => $profile_id])->with('message', 'Post was successfully deleted');
    }
}
