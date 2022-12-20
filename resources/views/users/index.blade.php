@extends('layouts.basic')

@section('title', 'User Index')

@section('content')
    <p>All users:</p>
    <ul>
        @foreach ($users as $user)
            <li>{{ $user->name }}</li>
        @endforeach
    </ul>

@endsection