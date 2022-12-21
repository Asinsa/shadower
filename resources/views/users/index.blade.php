@extends('layouts.basic')

@section('title', 'User Index')

@section('content')
    <p>All users:</p>
    <ul>
        @foreach ($users as $user)
            <li><a href='{{ route('users.show', ['id' => $user->id]) }}'>{{ $user->name }}</a></li>
        @endforeach
    </ul>

@endsection