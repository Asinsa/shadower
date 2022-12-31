@extends('layouts.basic')

@section('title', 'Post Index')

@section('content')
    <a href="{{ route('posts.create')}}">Create New Post</a>
    <p>All posts:</p>
    <ul>
        @foreach ($posts as $post)
            <li><a href='{{ route('posts.show', ['id' => $post->id]) }}'>{{ $post->title }}</a></li>
        @endforeach
    </ul>

@endsection