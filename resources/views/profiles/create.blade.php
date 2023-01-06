@extends('layouts.basic')

@section('title', 'New Profile')

@section('content')
<div class="item max-w-3xl">
    <div class="card mt-10 p-6">
        <form method="POST" action="{{ route('profiles.store') }}">
            @csrf
            <div class="mb-6">
                <label for="email" class="block mb-2 normal-text">Username:</label>
                <input type="text" name="username" value="{{ old('title') }}" class="small-form-input" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 normal-text">Profile Picture:</label>
                <input type="text" name="profile_pic" value="{{ old('image') }}" class="small-form-input">
            </div>
            <div class="flex justify-between">
                <a class="btn-main bg-gray-500" href="{{ route('users.show', ['id' => Auth::id()]) }}">Cancel</a>
                <button type="submit" class="btn-main align-center" value="Submit">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection