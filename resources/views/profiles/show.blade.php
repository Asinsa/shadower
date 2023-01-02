@extends('layouts.basic')

@section('title', 'Show Profile View')

@section('content')
    @if (session('message'))
        <p><b>{{ session('message') }}</b></p>
    @endif
    <ul>
        <li>Username: {{$profile->username}}</li>
        <li>Profile Pic: {{$profile->profile_pic}}</li>
        <li><img src={{$profile->profile_pic}} alt="Image" width="300" height="300"></li>
    </ul>

    <h2>Posts by {{$profile->username}}</h2>
    <ul>
        @foreach ($profile->posts as $post)
            <li><a href='{{ route('posts.show', ['id' => $post->id]) }}'>{{ $post->title }}</a></li>
        @endforeach
    </ul>

    <h2>Comments by {{$profile->username}}</h2>
    <ul>
        @foreach ($profile->interactions as $interaction)
            @if ( $interaction->interaction_type == "comment")
                <li>"{{ $interaction->comment }}" 
                on the post "<a href='{{ route('posts.show', ['id' => $interaction->post->id]) }}'>{{ $interaction->post->title }}</a>" 
                at {{$interaction->created_at}}.</li>
            @endif
        @endforeach
    </ul>

@endsection