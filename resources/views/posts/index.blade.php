@extends('layouts.basic')

@section('title', 'Post Index')

@section('content')
    @if (session('message'))
        <p><b>{{ session('message') }}</b></p>
    @endif
    @if(Auth::id() == null)
        <p><a href="{{ route('dashboard') }}">Login</a> To Post</p>
    @elseif(Auth::user()->profile == null)
        <p><a href="{{ route('profiles.create') }}">Make Profile</a> To Post</p>
    @else
        <a href="{{ route('posts.create')}}">Create New Post</a>
    @endif
    <p>All posts:</p>
    <ul>
        @foreach ($posts as $post)
            <li><a href='{{ route('posts.show', ['id' => $post->id]) }}'>{{ $post->title }}</a></li>
        @endforeach
    </ul>

@endsection