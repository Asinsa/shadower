@extends('layouts.basicnoheader')

@section('title', 'Post View')

@section('content')
    @if (session('post_message'))
        <p><b>{{ session('post_message') }}</b></p>
    @endif

    
    @if(Auth::check() && Auth::user()->profile != null)
        @if (Auth::user()->profile->id == $post->profile->id)
            <div class="flex mt-3 ml-8">
                <form method="POST" action="{{ route('posts.destroy', ['id' => $post->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class=btn-delete>Delete Post</button>
                </form>
                <form method="GET" action="{{ route('posts.edit', ['id' => $post->id]) }}">
                    @csrf
                    <button type="submit" class=btn-main>Edit Post</button>
                </form>
            </div>
        @endif
    @endif

    <div class="item mt-3">
        <div class="card">
            <div class="mb-4 ml-4">
                <div class="flex">
                    <div class="flex flex-col items-center p-3">
                        <a href='{{ route('profiles.show', ['id' => $post->profile->id]) }}'>
                            <img class="w-10 h-10 mb-1 rounded-full shadow-lg" src="{{ $post->profile->profile_pic }}" alt="Profile Pic"/>
                            <h5 class="username-text">{{ $post->profile->username }}</h5>
                        </a>
                    </div>
                    <div class="flex flex-grow items-center pb-2 pl-2 card-title">
                        <a href='{{ route('posts.show', ['id' => $post->id]) }}'>{{ $post->title }}</a>
                    </div>
                    <p class="date-text text-right">{{ $post->created_at }}</p>
                </div>
                <a href='{{ route('posts.show', ['id' => $post->id]) }}'>
                    <div>
                        <img class="mx-auto" src={{$post->image}} alt="Image" width="400" height="400">
                        <div class="normal-text mt-4">
                            {{ $post->body }}
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <br>
    </div>

    @if (session('message'))
        <p><b>{{ session('message') }}</b></p>
    @endif

    <div class="item mt-3">
        <div class="card">
            <div class="mb-4">
                <div class="flex">
                    <div class="flex flex-grow items-center pb-2 pl-2 card-title">
                        <h2 id="comments" class="card-title">Comments</h2>
                    </div>
                </div>
            </div>

            @foreach ($post->interactions as $interaction)
                @if ( $interaction->interaction_type == "comment")
                    <div class="comment-view">
                        <div class="comment-profilepic">
                            @if (($post->profile->profile_pic) == null)
                                <img src="https://images.unsplash.com/photo-1551122089-4e3e72477432?ixid=MXwxMjA3fDB8MHxzZWFyY2h8M3x8cnVieXxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="" class="h-8 w-8 object-fill rounded-full">
                            @else
                                <img class="h-8 w-8 object-fill rounded-full" src="{{ $post->profile->profile_pic }}" alt="Profile Pic"/>
                            @endif
                        </div>
                        <div class="block w-full">
                            <div class="comment-content">
                                <div class="flex justify-between">
                                    <a class="pr-4 commentuser-text" href='{{ route('profiles.show', ['id' => $interaction->profile->id]) }}'>{{ $interaction->profile->username }}</a>
                                    <p class="pl-4 date-text text-right">{{ $interaction->created_at }}</p>
                                </div>
                                <div class="normal-text">
                                    {{ $interaction->comment }}
                                </div>
                            </div>
                            <div class="flex justify-start items-center text-xs w-full">
                                <div class="hidden font-semibold text-gray-700 px-2 flex items-center justify-center space-x-1">
                                    <a href="#" class="hover:underline">
                                    ignore this for now it's a like button
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        @if(Auth::id() == $interaction->profile->user->id)
                            <form style="display:inline" method="POST" action="{{ route('interactions.destroy', ['id' => $interaction->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-smol-delete px-2 py-2">Delete</button>
                            </form>
                        @endif
                    </div>
                @endif
            @endforeach

            @if(Auth::id() == null)
                <div class=btn-main>
                    <a href="{{ route('dashboard') }}" class="btn-text">Login To Join Discussion</a>
                </div>
            @elseif(Auth::user()->profile == null)
                <div class=btn-main>
                    <a href="{{ route('profiles.create') }}" class="btn-text">Make Profile To Join Discussion</a>
                </div>
            @else
                <form method="POST" action="{{ route('interactions.store') }}">
                    @csrf
                    <div class="form-container">
                        <div class="form-top-section">
                            <textarea type="text" 
                                name="comment" 
                                rows="2" 
                                class="form-writing-section" placeholder="Write a comment..." required
                                value="{{ old('title') }}"></textarea>
                            <input type="hidden" name="post_id" value={{ $post->id }}>
                        </div>
                        <div class="form-bottom-section">
                            <button type="submit" class="btn-main">
                                Post comment
                            </button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection