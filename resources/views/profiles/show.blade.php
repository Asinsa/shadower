@extends('layouts.basicnoheader')

@section('title', 'Show Profile View')

@section('content')
    @if (session('message'))
        <div class="flex p-4 mt-10 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-gray-800 dark:text-green-400" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium"><b>{{ session('message') }}</b></span>
            </div>
        </div>
    @endif

    @if(Auth::check() && Auth::user()->profile != null)
        @if ((Auth::user()->profile->id == $profile->id) || (Auth::user()->roles->contains(1)))
            <div class="flex mt-3 ml-8">
                <form method="GET" action="{{ route('profiles.edit', ['id' => $profile->id]) }}">
                    @csrf
                    <button type="submit" class=btn-main>Edit Profile</button>
                </form>
            </div>
        @endif
    @endif

    <div class="item mt-3">
        <div class="card">
            <div class="justify-center m-5">
                <div class="flex flex-col items-center">
                    @if (($profile->image) == null)
                        <img class="mx-auto mb-1 rounded-full shadow-lg" src="https://images.unsplash.com/photo-1665517941611-42cb25703695?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=927&q=80" width="300" height="300" alt="Profile Pic"/>
                    @else
                        <img class=" mb-1 rounded-full shadow-lg" src={{ url($profile->image->url)}} width="300" height="300" alt="Profile Pic"/>
                    @endif
                    <h5 class="card-title">{{ $profile->username }}</h5>
                </div>
            </div>
        </div>
        <br>
    </div>

    <div class="flex flex-row">
        <div class="card basis-3/5 mr-2 p-0">
            <h2 class="card-title pt-3 pl-4">Posts by {{$profile->username}}</h2>
            @foreach ($profile->posts->reverse() as $post)
                <div class="comment-view m-3 pb-2">
                    <div class="block w-full">
                        <div class="comment-content">
                            <div class="flex">
                                <div class="flex flex-grow items-center pb-2 pl-2 card-title">
                                    <a href='{{ route('posts.show', ['id' => $post->id]) }}'>{{ $post->title }}</a>
                                </div>
                                <p class="date-text text-right">{{ $post->created_at }}</p>
                            </div>
                            <a href='{{ route('posts.show', ['id' => $post->id]) }}'>
                                <div>
                                    @if ($post->image != null)
                                        <img src={{ url($post->image->url)}} alt="Image" width="400" height="400">
                                    @endif
                                    <div class="normal-text mt-2">
                                        {{ $post->body }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    @if (Auth::check())
                        @if((Auth::id() == $profile->user->id) || (Auth::user()->roles->contains(1)))
                            <div class="flex flex-col justify-end">
                                <form style="display:inline" method="POST" action="{{ route('posts.destroy', ['id' => $post->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-smol-delete px-2 py-2">Delete</button>
                                </form>
                                <form style="display:inline" method="GET" action="{{ route('posts.edit', ['id' => $post->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn-smol-delete px-2 py-2">Edit</button>
                                </form>
                            </div>
                        @endif
                    @endif
                </div>
            @endforeach
        </div>
        <div class="card basis-2/5 ml-2 p-0">
            <h2 class="card-title pt-3 pl-4">Comments by {{$profile->username}}</h2>
            @foreach ($profile->interactions->reverse() as $interaction)
                @if ( $interaction->interaction_type == "comment")
                    <div class="comment-view m-3">
                        <div class="block w-full">
                            <div class="comment-content">
                                <div class="flex justify-between">
                                    <a class="pr-4 commentuser-text" href='{{ route('posts.show', ['id' => $interaction->post->id]) }}'>{{ $interaction->post->title }}</a>
                                    <p class="pl-4 date-text text-right">{{ $interaction->created_at }}</p>
                                </div>
                                <a href='{{ route('posts.show', ['id' => $interaction->post->id]) }}#comments'>
                                    <div class="normal-text">
                                        {{ $interaction->comment }}
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        @if (Auth::check())
                            @if((Auth::id() == $interaction->profile->user->id) || (Auth::user()->roles->contains(1)))
                                <div class="flex flex-col justify-end">
                                    <form style="display:inline" method="POST" action="{{ route('interactions.destroy', ['id' => $interaction->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-smol-delete px-2 py-2">Delete</button>
                                    </form>
                                    <form style="display:inline" method="GET" action="{{ route('interactions.edit', ['id' => $interaction->id]) }}">
                                        @csrf
                                        <button type="submit" class="btn-smol-delete px-2 py-2">Edit</button>
                                    </form>
                                </div>
                            @endif
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </div>

@endsection