@extends('layouts.basic')

@section('title', 'Show User View')

@section('content')
    <ul>
        <li>Name: {{$user->name}}</li>
        <li>Email: {{$user->email}}</li>
        <li>Email Verification: {{$user->email_verified_at ?? "Unknown" }}</li>
        <li>Profile: 
            @foreach ($profiles as $profile)
                @if ($profile->user_id == $user->id)
                    <a href='/profiles/{{$profile->id}}'>{{ $profile->username }}</a>
                @endif
            @endforeach
        </li>
    </ul>

@endsection