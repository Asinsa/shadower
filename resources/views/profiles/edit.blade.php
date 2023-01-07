@extends('layouts.basic')

@section('title', 'Edit Profile')

@section('content')
<div class="item max-w-3xl">
    <div class="card mt-10 p-6">
        <form method="POST" action="{{ route('profiles.update', ['id' => $profile->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label class="block mb-2 normal-text">Username:</label>
                <input type="text" name="username" value="{{ $profile->username }}" class="small-form-input" required>
            </div>
            <div class="mb-6">
                <label class="block mb-2 normal-text">Profile Picture:</label>
                <input type="file" name="profile_pic" value="{{ $profile->profile_pic }}" class="small-form-input">
            </div>
            <div class="flex justify-between">
                <a class="btn-main bg-gray-500" href="{{ route('profiles.show', ['id' => $profile->id]) }}">Cancel</a>
                <button type="submit" class="btn-main align-center" value="Submit">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection