@extends('layouts.basic')

@section('title', 'Show Profile View')

@section('content')
    <ul>
        <li>Username: {{$profile->username}}</li>
        <li>Profile Pic: {{$profile->profile_pic}}</li>
        <li><img src={{$profile->profile_pic}} alt="Image" width="300" height="300"></li>
    </ul>

@endsection