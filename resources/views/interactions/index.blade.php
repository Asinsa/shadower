@extends('layouts.basic')

@section('title', 'Interaction Index')

@section('content')
    <p>All interactions:</p>
    <ul>
        @foreach ($interactions as $interaction)
            <li>{{ $interaction->id }} - {{ $interaction->interaction_type }} - {{ $interaction->comment }}</li>
        @endforeach
    </ul>

@endsection