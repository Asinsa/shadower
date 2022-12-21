@extends('layouts.basic')

@section('title', 'Profile Index')

@section('content')
    <p>All profiles:</p>
    <ul>
        @foreach ($profiles as $profile)
            <li><a href='{{ route('profiles.show', ['id' => $profile->id]) }}'>{{ $profile->username }}</a></li>
        @endforeach
    </ul>

@endsection