@extends('layouts.basic')

@section('title', 'Show User View')

@section('content')
    @if (session('message'))
        <div class="flex p-4 mt-10 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-gray-800 dark:text-green-400" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium"><b>{{ session('message') }}</b></span>
            </div>
        </div>
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