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
                            <a href='{{ route('posts.show', ['id' => $post->id]) }}'>
                            <div class="flex flex-col items-center p-3">
                                <a href='{{ route('posts.show', ['id' => $post->id]) }}'>
                                    <img class="w-10 h-10 mb-1 rounded-full shadow-lg" src="{{ $post->profile->profile_pic }}" alt="Profile Pic"/>
                                    <h5 class="username-text">{{ $post->profile->username }}</h5>
                                </a>
                            </div>
                            <div class="flex flex-grow items-center pb-2 pl-2 card-title">
                                <a href='{{ route('posts.show', ['id' => $post->id]) }}'>{{ $post->title }}</a>
                            </div>
                            <p class="date-text text-right">{{ $post->created_at }}</p>
                        </div>
                        <div>
                            <img src={{$post->image}} alt="Image" width="400" height="400">
                            <div class="normal-text mt-4">
                                {{ $post->body }}
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            @endforeach
    </div>

@endsection