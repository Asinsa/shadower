@extends('layouts.basic')

@section('title', 'Profiles')

@section('content')
<div class="p-6 justify-center grid grid-cols-4 gap-2">
    @foreach ($profiles as $profile)
        <a href='{{ route('profiles.show', ['id' => $profile->id]) }}'>
            <div class="m-4 w-50 bg-neutral-900 rounded-2xl px-8 py-6 shadow-lg ">
                <div class="m-6 w-fit mx-auto ">
                    @if (($profile->image) == null)
                        <img class="mx-auto w-10 h-10 mb-1 rounded-full shadow-lg" src="https://images.unsplash.com/photo-1665517941611-42cb25703695?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=927&q=80" width="300" height="300" alt="Profile Pic"/>
                    @else
                        <img src={{ url($profile->image->url)}} class="mx-auto rounded-full w-20" alt="profile picture">
                    @endif
                    <h2 class="pt-3 text-center normal-text font-semibold">{{ $profile->username }}</h2>
                </div>
            </div>
        </a>
    @endforeach
</div>

@endsection