@extends('layouts.basic')

@section('title', 'Edit Comment')

@section('content')
    <div class="item max-w-3xl">
        <div class="card mt-10 p-6">
            <form method="POST" action="{{ route('interactions.update', ['id' => $interaction->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label class="block mb-2 normal-text">Comment:</label>
                    <input type="text" name="comment" value="{{ $interaction->comment }}" class="small-form-input" required>
                </div>
                <div class="flex justify-between">
                    <a class="btn-main bg-gray-500" href="{{ route('posts.show', ['id' => $interaction->post->id]) }}">Cancel</a>
                    <button type="submit" class="btn-main align-center" value="Submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection