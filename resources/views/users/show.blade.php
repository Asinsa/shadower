@extends('layouts.basic')

@section('title', 'Show User View')

@section('content')
    <ul>
        <li>Name: {{$user->name}}</li>
        <li>Email: {{$user->email}}</li>
        <li>Email Verification: {{$user->email_verified_at ?? "Unknown" }}</li>
        <li>Profile: <a href='{{ route('profiles.show', ['id' => $user->profile->id]) }}'>{{ $user->profile->username }}</a></li>
    </ul>

@endsection