@extends('layouts.basic')

@section('title', 'Show User View')

@section('content')
    <ul>
        <li>Name: {{$user->name}}</li>
        <li>Email: {{$user->email}}</li>
        <li>Email Verification: {{$user->email_verified_at ?? "Unknown" }}</li>
        @if ($user->profile != null)
            <li>Profile: <a href='{{ route('profiles.show', ['id' => $user->profile->id]) }}'>{{ $user->profile->username }}</a></li>
        @elseif(Auth::id() == $user->id)
            <a href="{{ route('profiles.create')}}">Create New Profile</a>
        @else
            <li>No Profile</li>
        @endif
    </ul>

@endsection