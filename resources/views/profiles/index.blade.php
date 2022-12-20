@extends('layouts.basic')

@section('title', 'Profile Index')

@section('content')
    <p>All profiles:</p>
    <ul>
        @foreach ($profiles as $profile)
            <li>{{ $profile->username }}</li>
        @endforeach
    </ul>

@endsection