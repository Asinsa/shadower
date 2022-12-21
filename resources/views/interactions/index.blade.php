@extends('layouts.basic')

@section('title', 'Interaction Index')

@section('content')
    <p>All interactions:</p>
    <ul>
        @foreach ($interactions as $interaction)
            @if ( $interaction->interaction_type == "comment")
                <li>{{ $interaction->profile->username }} commented "{{ $interaction->comment }}" on the post "{{ $interaction->post->title }}"
            @elseif ($interaction->interaction_type == "like")
                <li>{{ $interaction->profile->username }} liked the post "{{ $interaction->post->title }}"
            @else
                Unknown
            @endif
             at {{$interaction->created_at}}</li>
        @endforeach
    </ul>

@endsection