@extends('layouts.basic')

@section('title', 'Profiles')

@section('content')
@if (session('fact'))
    <div class="flex justify-center p-4 mt-10 mb-4 text-sm text-sky-500 bg-green-100 rounded-lg dark:bg-gray-800 dark:text-sky-500" role="alert">
        <div>
        <span class="font-medium"><b>Random Fact: </b>{{ session('fact') }}</span>
        </div>
    </div>
@endif
<div class="p-6 justify-center grid grid-cols-4 gap-2">
    @foreach ($profiles as $profile)
        <a href='{{ route('profiles.show', ['id' => $profile->id]) }}'>
            <div class="m-4 w-50 bg-neutral-900 rounded-2xl px-8 py-6 shadow-lg ">
                <div class="m-6 w-fit mx-auto ">
                    @if (($profile->image) == null)
                        @if($profile->user->roles->contains(1))
                            <img class="mx-auto w-20 mb-1 rounded-full shadow-lg p-1 ring-2 ring-lime-500" src="https://images.unsplash.com/photo-1665517941611-42cb25703695?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=927&q=80" alt="Profile Pic"/>
                        @else
                            <img class="mx-auto w-20 mb-1 rounded-full shadow-lg" src="https://images.unsplash.com/photo-1665517941611-42cb25703695?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=927&q=80" alt="Profile Pic"/>
                        @endif
                    @else
                        @if($profile->user->roles->contains(1))
                            <img src={{ url($profile->image->url)}} class="mx-auto rounded-full w-20 p-1 ring-2 ring-lime-500" alt="profile picture">
                        @else
                            <img src={{ url($profile->image->url)}} class="mx-auto rounded-full w-20" alt="profile picture">
                        @endif
                    @endif
                    <h2 class="pt-3 text-center normal-text font-semibold">{{ $profile->username }}</h2>
                </div>
            </div>
        </a>
    @endforeach
</div>

@endsection