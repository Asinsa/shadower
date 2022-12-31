@extends('layouts.basic')

@section('title', 'New Post')

@section('content')
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <p>Title: <input type="text" name="title"></p>
        <p>Image Link: <input type="text" name="image"></p>
        <p>Body: <input type="text" name="body"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.index') }}">Cancel</a>
    </form>

@endsection