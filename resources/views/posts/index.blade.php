@extends('layouts.basic')

@section('title', 'All Posts')

@section('content')
    @if (session('fact'))
        <div class="flex justify-center p-4 mt-10 mb-4 text-sm text-sky-500 bg-green-100 rounded-lg dark:bg-gray-800 dark:text-sky-500" role="alert">
            <div>
            <span class="font-medium"><b>Random Fact: </b>{{ session('fact') }}</span>
            </div>
        </div>
    @endif

    @if (session('message'))
        <div class="flex p-4 mt-10 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-gray-800 dark:text-green-400" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium"><b>{{ session('message') }}</b></span>
            </div>
        </div>
    @endif
    <br>
    <div class=btn-main>
        @if(!Auth::check())
            <a href="{{ route('dashboard') }}" class="btn-text">Login To Post</a>
        @elseif(Auth::user()->profile == null)
            <a href="{{ route('profiles.create') }}" class="btn-text">Make Profile To Post</a>
        @else
            <a href="{{ route('posts.create')}}" class="btn-text">Create New Post</a>
        @endif
    </div>
    <br>

    @foreach ($posts as $post)
        <div class="item">
            <div class="card">
                <div class="flex justify-between">
                    @include('components/viewcount-image')
                    <p class="date-text text-right">{{ $post->created_at }}</p>
                </div>
                <div class="m-4">
                    <div class="flex">
                        <div class="flex flex-col items-center p-3">
                            <a href='{{ route('profiles.show', ['id' => $post->profile->id]) }}'>
                                @if (($post->profile->image) == null)
                                    @if($post->profile->user->roles->contains(1))
                                        <img class="mx-auto w-10 h-10 mb-1 rounded-full shadow-lg p-1 ring-2 ring-lime-500" src="https://images.unsplash.com/photo-1665517941611-42cb25703695?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=927&q=80" alt="Profile Pic"/>
                                    @else
                                        <img class="mx-auto w-10 h-10 mb-1 rounded-full shadow-lg" src="https://images.unsplash.com/photo-1665517941611-42cb25703695?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=927&q=80" alt="Profile Pic"/>
                                    @endif
                                @else
                                    @if($post->profile->user->roles->contains(1))
                                        <img class="mx-auto w-10 h-10 mb-1 rounded-full shadow-lg p-1 ring-2 ring-lime-500" src={{ url($post->profile->image->url)}} alt="Profile Pic"/>
                                    @else
                                        <img class="mx-auto w-10 h-10 mb-1 rounded-full shadow-lg" src={{ url($post->profile->image->url)}} alt="Profile Pic"/>
                                    @endif
                                @endif
                                <h5 class="username-text">{{ $post->profile->username }}</h5>
                            </a>
                        </div>
                        <div class="flex flex-grow items-center pb-2 pl-2 card-title">
                            <a href='{{ route('posts.show', ['id' => $post->id]) }}'>{{ $post->title }}</a>
                        </div>
                    </div>
                    <a href='{{ route('posts.show', ['id' => $post->id]) }}'>
                        <div>
                            @if($post->image != null)
                                <img class="mx-auto" src={{ url($post->image->url)}} alt="Image" height="100">
                            @endif
                            <div class="normal-text mt-4">
                                {{ $post->body }}
                            </div>
                        </div>
                    </a>
                </div>
                <div class="flex justify-between">
                    <p></p>
                    <div class="mb-3" >
                        @include('components/comments-button', ['item' => $post], ['route' => 'posts.show'])
                    </div>
                    <div class="grid place-items-end">
                        <livewire:likes :post="$post"/>
                    </div>

                    {{-- <div class="grid grid-cols-2 place-items-end">
                        @if (!Auth::check())
                            <div class="self-center mt-9 date-text font-bold">
                                <p>{{ DB::table('interactions')->where('interaction_type', 'like')->where('post_id', $post->id)->count() }} Likes</p>
                            </div>
                            <a href="{{ route('dashboard') }}" class="h-12 w-12 hover:text-white focus:outline-none rounded-full text-center inline-flex items-center  dark:text-white ">
                                <svg class="w-10 h-10 ml-0.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                            </a>
                        @elseif (Auth::user()->profile == null)
                            <div class="self-center mt-9 date-text font-bold">
                                <p>{{ DB::table('interactions')->where('interaction_type', 'like')->where('post_id', $post->id)->count() }} Likes</p>
                            </div>
                            <a href="{{ route('profiles.create') }}" class="h-12 w-12 hover:text-white focus:outline-none rounded-full text-center inline-flex items-center  dark:text-white ">
                                <svg class="w-10 h-10 ml-0.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                            </a>
                        @else
                            @if (DB::table('interactions')->where('interaction_type', 'like')->where('post_id', $post->id)->where('profile_id', Auth::user()->profile->id)->exists())
                                <div class="self-center mt-9 date-text font-bold text-red-500">
                                    <p>{{ DB::table('interactions')->where('interaction_type', 'like')->where('post_id', $post->id)->count() }} Likes</p>
                                </div>
                                <button type="button" class="h-12 w-12 text-blue-700 hover:text-white focus:outline-none rounded-full text-center inline-flex items-center  dark:text-red-600 ">
                                    <svg class="w-10 h-10 ml-0.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                                </button>
                            @else
                                <div class="self-center mt-9 date-text font-bold">
                                    <p>{{ DB::table('interactions')->where('interaction_type', 'like')->where('post_id', $post->id)->count() }} Likes</p>
                                </div>
                                <form method="POST" action="{{ route('interactions.store') }}">
                                    @csrf
                                    <input type="hidden" name="redirect_to" value="all">
                                    <input type="hidden" name="post_id" value={{ $post->id }}>
                                    <input type="hidden" name="interaction_type" value="like">
                                    <button type="submit" class="mt-6 h-12 w-12 text-red-600 hover:text-red-600 focus:outline-none rounded-full text-center inline-flex items-center  dark:text-white ">
                                        <svg class="w-10 h-10 ml-0.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div> --}}
                </div>
            </div>
            <br>
        </div>
    @endforeach

    {{ $posts->links() }}

@endsection