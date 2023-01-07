@extends('layouts.basic')

@section('title', 'Edit Post')

@section('content')
    <div class="item max-w-4xl">
        <div class="card mt-10 p-6">
            <form method="POST" action="{{ route('posts.update', ['id' => $post->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label class="block mb-2 normal-text">Title:</label>
                    <input type="text" name="title" value="{{ $post->title }}" class="small-form-input" required>
                </div>
                <div class="mb-6">
                    <label class="block mb-2 normal-text">Image Upload:</label>
                    <input type="file" name="image" class="small-form-input">
                </div>
                <div class="mb-6">
                    <label class="block mb-2 normal-text">Content:</label>
                    <input type="text" name="body"  value="{{ $post->body }}" class="small-form-input">
                </div>
                <div class="flex justify-between">
                    <a class="btn-main bg-gray-500" href="{{ route('posts.show', ['id' => $post->id]) }}">Cancel</a>
                    <button type="submit" class="btn-main align-center" value="Submit">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection