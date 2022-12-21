@extends('layouts.basic')

@section('title', 'Show Post View')

@section('content')
    <ul>
        <li>Title: {{$post->title}}</li>
        <li>Image: {{$post->image}}</li>
        <li><img src={{$post->image}} alt="Image" width="300" height="300"></li>
        <li>Body: {{$post->body}}</li>
        <li>Poster: <a href='{{ route('profiles.show', ['id' => $post->profile->id]) }}'>{{ $post->profile->username }}</a></li>
    </ul>

    <h2>Comments</h2>
    <ul>
        @foreach ($post->interactions as $interaction)
            @if ( $interaction->interaction_type == "comment")
                <li><a href='{{ route('profiles.show', ['id' => $interaction->profile->id]) }}'>{{ $interaction->profile->username }}</a>
                 commented "{{ $interaction->comment }}"
                 at {{$interaction->created_at}}.</li>
            @endif
        @endforeach
    </ul>

@endsection