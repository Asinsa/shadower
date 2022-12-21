@extends('layouts.basic')

@section('title', 'Show User View')

@section('content')
    <ul>
        <li>Name: {{$user->name}}</li>
        <li>Email: {{$user->email}}</li>
        <li>Email Verification: {{$user->email_verified_at ?? "Unknown" }}</li>
        <li>Profile/s: </li>
        <ul>
            @foreach ($profiles as $profile)
                @if ($profile->user_id == $user->id)
                    <li><a href='/profiles/{{$profile->id}}'>{{ $profile->username }}</a></li>
                @endif
            @endforeach
        </ul>
    </ul>

@endsection