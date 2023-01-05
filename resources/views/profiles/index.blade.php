@extends('layouts.basic')

@section('title', 'Profiles')

@section('content')
<div class="p-6 justify-center grid grid-cols-4 gap-2">
    @foreach ($profiles as $profile)
        <a href='{{ route('profiles.show', ['id' => $profile->id]) }}'>
            <div class="m-4 w-50 bg-neutral-900 rounded-2xl px-8 py-6 shadow-lg ">
                <div class="m-6 w-fit mx-auto ">
                    <img src="{{ $profile->profile_pic }}" class="mx-auto rounded-full w-20" alt="profile picture">
                    <h2 class="pt-3 text-center normal-text font-semibold">{{ $profile->username }}</h2>
                </div>
            </div>
        </a>
    @endforeach
</div>

@endsection