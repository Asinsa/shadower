@extends('layouts.basic')

@section('title', 'Show User View')

@section('content')
    @if (session('message'))
        <p><b>{{ session('message') }}</b></p>
    @endif
    <ul>
        <li>Name: {{$user->name}}</li>
        <li>Email: {{$user->email}}</li>
        <li>Email Verification: {{$user->email_verified_at ?? "Unknown" }}</li>
        @if ($user->profile != null)
            <li>Profile: <a href='{{ route('profiles.show', ['id' => $user->profile->id]) }}'>{{ $user->profile->username }}</a>
            @if((Auth::id() == $user->id) || (Auth::user()->roles->contains(1)))
                <form style="display:inline" method="POST" action="{{ route('profiles.destroy', ['id' => $user->profile->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete Profile</button>
                </form>
            @endif
            </li>
        @elseif((Auth::id() == $user->id) || (Auth::user()->roles->contains(1)))
            <a href="{{ route('profiles.create')}}">Create New Profile</a>
        @else
            <li>No Profile</li>
        @endif
    </ul>

@endsection