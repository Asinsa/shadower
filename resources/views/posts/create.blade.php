@extends('layouts.basic')

@section('title', 'New Post')

@section('content')
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <p>Title: <input type="text" name="title" class=small-form-input
            value="{{ old('title') }}"></p>
        <p>Image Upload: <input type="file" name="image" class="small-form-input"
            value="{{ old('image') }}"></p>
        <p>Body: <input type="text" name="body" class=small-form-input
            value="{{ old('body') }}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.index') }}">Cancel</a>
    </form>

@endsection