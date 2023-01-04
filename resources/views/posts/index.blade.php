@extends('layouts.basic')

@section('title', 'All Posts')

@section('content')
    @if (session('message'))
        <p><b>{{ session('message') }}</b></p>
    @endif
    <br>
    <div class=btn-main>
        @if(!Auth::check())
            <p><a href="{{ route('dashboard') }}" class=btn-text>Login</a> To Post</p>
        @elseif(Auth::user()->profile == null)
            <p><a href="{{ route('profiles.create') }}" class=btn-text>Make Profile</a> To Post</p>
        @else
            <a href="{{ route('posts.create')}}" class=btn-text>Create New Post</a>
        @endif
    </div>
    <br>

    <ul>
        @foreach ($posts as $post)
            <li><a href='{{ route('posts.show', ['id' => $post->id]) }}'>{{ $post->title }}</a></li>
        @endforeach
    </ul>

@endsection