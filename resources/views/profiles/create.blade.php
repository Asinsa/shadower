@extends('layouts.basic')

@section('title', 'New Profile')

@section('content')
    <form method="POST" action="{{ route('profiles.store') }}">
        @csrf
        <p>Username: <input type="text" name="username"
            value="{{ old('title') }}"></p>
        <p>Profile Picture: <input type="text" name="profile_pic"
            value="{{ old('image') }}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('users.show', ['id' => Auth::id()]) }}">Cancel</a>
    </form>

@endsection