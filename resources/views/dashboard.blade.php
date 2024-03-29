@extends('layouts.basic')

@section('title', 'Dashboard')

@section('content')
    <div class="py-12">
        <div class="item">
            <div class="card">
                You're logged in!
            </div>
        </div>
    </div>

    @if(Auth::user()->profile != null)
        <div class="flex mt-3 ml-8">
            <form method="GET" action="{{ route('profiles.edit', ['id' => Auth::user()->profile->id]) }}">
                @csrf
                <button type="submit" class=btn-main>Edit Profile</button>
            </form>
        </div>
        <div class="item mt-3">
            <div class="card">
                <div class="flex justify-end">
                    @if (Auth::user()->roles->contains(1))
                        <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Admin</span>
                    @endif
                </div>
                <div class="justify-center m-5">
                    <div class="flex flex-col items-center">
                        @if ((Auth::user()->profile->image) == null)
                            <img class=" mb-1 rounded-full shadow-lg" src="https://images.unsplash.com/photo-1665517941611-42cb25703695?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=927&q=80" width="300" height="300" alt="Profile Pic"/>
                        @else
                            <img class=" mb-1 rounded-full shadow-lg" src={{ url(Auth::user()->profile->image->url) }} width="300" height="300" alt="Profile Pic"/>
                        @endif
                        <h5 class="card-title">{{ Auth::user()->profile->username }}</h5>
                        
                    </div>
                </div>
            </div>
            <br>
        </div>

        <div class="flex flex-row">
            <div class="card basis-3/5 mr-2 p-0">
                <h2 class="card-title pt-3 pl-4">Your Posts</h2>
                @foreach (Auth::user()->profile->posts->reverse() as $post)
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
                    </div>
                @endforeach
            </div>
            <div class="card basis-2/5 ml-2 p-0">
                <h2 class="card-title pt-3 pl-4">Your Comments</h2>
                @foreach (Auth::user()->profile->interactions->reverse() as $interaction)
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
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @else
        <div class=btn-main>
            <a href="{{ route('profiles.create') }}" class="btn-text">Make Profile To Join Discussion</a>
        </div>
    @endif
@endsection