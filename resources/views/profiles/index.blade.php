@extends('layouts.basic')

@section('title', 'Profiles')

@section('content')
    <h1 class="py-5 max-w-7xl mx-auto sm:px-6 lg:px-8 p-6">All profiles:</h1>

    <div class="py-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @foreach ($profiles as $profile)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <a href='{{ route('profiles.show', ['id' => $profile->id]) }}'>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            {{ $profile->username }}
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection