@extends('layouts.basic')

@section('title', 'All Posts')

@section('content')
    @if (session('message'))
        <p><b>{{ session('message') }}</b></p>
    @endif
    <br>
    <div class=btn-main>
        @if(!Auth::check())
            <a href="{{ route('dashboard') }}" class="btn-text">Login To Post</a>
        @elseif(Auth::user()->profile == null)
            <a href="{{ route('profiles.create') }}" class="btn-text">Make Profile To Post</a>
        @else
            <a href="{{ route('posts.create')}}" class="btn-text">Create New Post</a>
        @endif
    </div>
    <br>

    <div class="main-scrolly-section">
        @foreach ($posts as $post)
            <div class="item">
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
                                <img src={{$post->image}} alt="Image" width="400" height="400">
                                <div class="normal-text mt-4">
                                    {{ $post->body }}
                                </div>
                            </div>
                            <div class="flex justify-center mr-4">
                                <div class="mt-4 btn-comment">
                                    <svg aria-hidden="true" class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 121.86 122.88" xmlns="http://www.w3.org/2000/svg"><path d="M30.28,110.09,49.37,91.78A3.84,3.84,0,0,1,52,90.72h60a2.15,2.15,0,0,0,2.16-2.16V9.82a2.16,2.16,0,0,0-.64-1.52A2.19,2.19,0,0,0,112,7.66H9.82A2.24,2.24,0,0,0,7.65,9.82V88.55a2.19,2.19,0,0,0,2.17,2.16H26.46a3.83,3.83,0,0,1,3.82,3.83v15.55ZM28.45,63.56a3.83,3.83,0,1,1,0-7.66h53a3.83,3.83,0,0,1,0,7.66Zm0-24.86a3.83,3.83,0,1,1,0-7.65h65a3.83,3.83,0,0,1,0,7.65ZM53.54,98.36,29.27,121.64a3.82,3.82,0,0,1-6.64-2.59V98.36H9.82A9.87,9.87,0,0,1,0,88.55V9.82A9.9,9.9,0,0,1,9.82,0H112a9.87,9.87,0,0,1,9.82,9.82V88.55A9.85,9.85,0,0,1,112,98.36Z"></path></svg>
                                    <a href='{{ route('posts.show', ['id' => $post->id]) }}'>Comments</a>
                                    <span class="inline-flex items-center justify-center w-4 h-4 ml-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                        2
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <br>
            </div>
            @endforeach
    </div>

@endsection