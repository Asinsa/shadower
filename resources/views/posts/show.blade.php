@extends('layouts.basic')

@section('title', 'Show Post View')

@section('content')
    <ul>
        <li>Title: {{$post->title}}</li>
        <li>Image: {{$post->image}}</li>
        <li><img src={{$post->image}} alt="Image" width="300" height="300"></li>
        <li>Body: {{$post->body}}</li>
    </ul>

@endsection