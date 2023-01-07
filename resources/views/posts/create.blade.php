@extends('layouts.basic')

@section('title', 'New Post')

@section('content')
    <div class="item max-w-3xl">
        <div class="card mt-10 p-6">
            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label class="block mb-2 normal-text">Title:</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="small-form-input" required>
                </div>
                <div class="mb-6">
                    <label class="block mb-2 normal-text">Image Upload:</label>
                    <input type="file" name="image" value="{{ old('image') }}" class="small-form-input">
                </div>
                <div class="mb-6">
                    <label class="block mb-2 normal-text">Content:</label>
                    <input type="text" name="body" value="{{ old('body') }}" class="small-form-input" required>
                </div>
                <div class="flex justify-between">
                    <a class="btn-main bg-gray-500" href="{{ route('posts.index') }}">Cancel</a>
                    <button type="submit" class="btn-main align-center" value="Submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection