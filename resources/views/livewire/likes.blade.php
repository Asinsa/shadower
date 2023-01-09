<div>
    <div class="grid grid-cols-2 place-items-end">
        @if (!Auth::check())
            <div class="self-center mt-2 date-text font-bold">
                <p>{{ DB::table('interactions')->where('interaction_type', 'like')->where('post_id', $post->id)->count() }} Likes</p>
            </div>
            <a href="{{ route('dashboard') }}" class="h-12 w-12 hover:text-white focus:outline-none rounded-full text-center inline-flex items-center  dark:text-white ">
                <svg class="w-10 h-10 ml-0.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
            </a>
        @elseif (Auth::user()->profile == null)
            <div class="self-center mt-2 date-text font-bold">
                <p>{{ DB::table('interactions')->where('interaction_type', 'like')->where('post_id', $post->id)->count() }} Likes</p>
            </div>
            <a href="{{ route('profiles.create') }}" class="h-12 w-12 hover:text-white focus:outline-none rounded-full text-center inline-flex items-center  dark:text-white ">
                <svg class="w-10 h-10 ml-0.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
            </a>
        @else
            @if (DB::table('interactions')->where('interaction_type', 'like')->where('post_id', $post->id)->where('profile_id', Auth::user()->profile->id)->exists())
                <div class="self-center mt-2 date-text font-bold text-red-500">
                    <p>{{ DB::table('interactions')->where('interaction_type', 'like')->where('post_id', $post->id)->count() }} Likes</p>
                </div>
                <button type="button" class="h-12 w-12 text-blue-700 hover:text-white focus:outline-none rounded-full text-center inline-flex items-center  dark:text-red-600 ">
                    <svg class="w-10 h-10 ml-0.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                </button>
            @else
                <div class="self-center mt-2 date-text font-bold">
                    <p>{{ DB::table('interactions')->where('interaction_type', 'like')->where('post_id', $post->id)->count() }} Likes</p>
                </div>
                <button wire:click="addLike" type="submit" class="h-12 w-12 text-red-600 hover:text-red-600 focus:outline-none rounded-full text-center inline-flex items-center  dark:text-white ">
                    <svg class="w-10 h-10 ml-0.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                </button>
            @endif
        @endif
    </div>
</div>