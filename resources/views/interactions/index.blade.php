@extends('layouts.basic')

@section('title', 'Interaction Index')

@section('content')
    <p>All interactions (from most to least recent):</p>
    <ul>
        @foreach ($interactions->reverse() as $interaction)
            <li><a href='{{ route('profiles.show', ['id' => $interaction->profile->id]) }}'>{{ $interaction->profile->username }}</a>
            @if ( $interaction->interaction_type == "comment")
                 commented "{{ $interaction->comment }}" on
            @elseif ($interaction->interaction_type == "like")
                 liked
            @else
                Unknown
            @endif
             the post "<a href='{{ route('posts.show', ['id' => $interaction->post->id]) }}'>{{ $interaction->post->title }}</a>" 
             at {{$interaction->created_at}}.</li>
        @endforeach
    </ul>

@endsection