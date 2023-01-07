<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(10);
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
            'image' => 'nullable|file|max:5000',
            'body' => 'nullable|max:2000',
        ]);

        $post = new Post;
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->profile_id = Auth::user()->profile->id;
        $post->save();

        if ($request->hasFile('image')) {
            $filename = time().$request->file('image')->getClientOriginalName();
            $path = $request->file('image')->move('images/post_images/', $filename);

            $image = new Image;
            $image->url = $path;

            $post->image()->save($image);
        }

        session()->flash('message', 'Post was successfully created!');
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $post = Post::findOrFail($id);

        if(!Auth::check()){
            $cookie = (Str::replace('.','',($request->ip())).'-'. $post->id);
        } else {
            $cookie = (Auth::user()->id.'-'. $post->id);
        }
        if(Cookie::get($cookie) == ''){
            $cookie = cookie($cookie, '1', 60);
            $post->incrementViewCount();
            return response()->view('posts.show',['post' => $post])->withCookie($cookie);
        } else {
            return view('posts.show', ['post' => $post]);
        }
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
            'image' => 'nullable|file|max:5000',
            'body' => 'nullable|max:2000',
        ]);

        if ($request['image'] != null) {
            if ($request->hasFile('image')) {
                $filename = time().$request->file('image')->getClientOriginalName();
                $path = $request->file('image')->move('images/post_images/', $filename);
    
                if(File::exists($post->image->url)) {
                    File::delete($post->image->url);
                }
                $post->image()->delete();
                $image = new Image;
                $image->url = $path;
    
                $post->image()->save($image);
            }
        }

        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->save();

        if ($post->wasChanged()) {
            session()->flash('message', 'Post was successfully edited!');
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
