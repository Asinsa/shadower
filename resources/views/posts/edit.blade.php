@extends('layouts.basic')

@section('title', 'Edit Post')

@section('content')
    <form method="POST" action="{{ route('posts.update', ['id' => $post->id]) }}">
        @csrf
        @method('PUT')
        <p>Title: <input type="text" name="title"
            value="{{ $post->title }}"></p>
        <p>Image Link: <input type="text" name="image"
            value="{{ $post->image }}"></p>
        <p>Body: <input type="text" name="body"
            value="{{ $post->body }}"></p>
        <input type="submit" value="Save">
        <a href="{{ route('posts.index') }}">Cancel</a>
    </form>

@endsection