@extends('layouts.basic')

@section('title', 'Post Index')

@section('content')
    <p>All posts:</p>
    <ul>
        @foreach ($posts as $post)
            <li>{{ $post->title }}</li>
        @endforeach
    </ul>

@endsection