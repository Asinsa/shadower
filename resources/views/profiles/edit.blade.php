@extends('layouts.basic')

@section('title', 'Edit Profile')

@section('content')
    <form method="POST" action="{{ route('profiles.update', ['id' => $profile->id]) }}">
        @csrf
        @method('PUT')
        <p>Username: <input type="text" name="username"
            value="{{ $profile->username }}"></p>
        <p>Profile Picture: <input type="text" name="profile_pic"
            value="{{ $profile->profile_pic }}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('profiles.show', ['id' => $profile->id]) }}">Cancel</a>
    </form>

@endsection