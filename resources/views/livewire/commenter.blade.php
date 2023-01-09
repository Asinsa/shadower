<div>
    @foreach ($post->interactions as $interaction)
        @if ( $interaction->interaction_type == "comment")
            <div class="comment-view">
                <div class="comment-profilepic">
                    @if (($interaction->profile->image) == null)
                        @if($interaction->profile->user->roles->contains(1))
                            <img src="https://images.unsplash.com/photo-1551122089-4e3e72477432?ixid=MXwxMjA3fDB8MHxzZWFyY2h8M3x8cnVieXxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="" class="h-8 w-8 object-fill rounded-full p-1 ring-2 ring-lime-500">
                        @else
                            <img src="https://images.unsplash.com/photo-1551122089-4e3e72477432?ixid=MXwxMjA3fDB8MHxzZWFyY2h8M3x8cnVieXxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="" class="h-8 w-8 object-fill rounded-full">
                        @endif
                    @else
                        @if($interaction->profile->user->roles->contains(1))
                            <img class="h-8 w-8 object-fill rounded-full p-1 ring-2 ring-lime-500" src={{ url($interaction->profile->image->url)}} alt="Profile Pic"/>
                        @else
                            <img class="h-8 w-8 object-fill rounded-full" src={{ url($interaction->profile->image->url)}} alt="Profile Pic"/>
                        @endif
                    @endif
                </div>
                <div class="block w-full">
                    <div class="comment-content">
                        <div class="flex justify-between">
                            <a class="pr-4 commentuser-text" href='{{ route('profiles.show', ['id' => $interaction->profile->id]) }}'>{{ $interaction->profile->username }}</a>
                            <p class="pl-4 date-text text-right">{{ $interaction->created_at }}</p>
                        </div>
                        <div class="normal-text">
                            {{ $interaction->comment }}
                        </div>
                    </div>
                </div>
                
                @if (Auth::check())
                    @if((Auth::id() == $interaction->profile->user->id) || (Auth::user()->roles->contains(1)))
                        <div class="flex flex-col justify-end">
                            <form wire:submit.prevent="DeleteComment({{ $interaction->id }})" style="display:inline">
                                <button type="submit" class="btn-smol-delete px-2 py-2">Delete</button>
                            </form>
                            <form style="display:inline" method="GET" action="{{ route('interactions.edit', ['id' => $interaction->id]) }}">
                                @csrf
                                <button type="submit" class="btn-smol-delete px-2 py-2">Edit</button>
                            </form>
                        </div>
                    @endif
                @endif
            </div>
        @endif
    @endforeach

    @if(!Auth::check())
        <div class=btn-main>
            <a href="{{ route('dashboard') }}" class="btn-text">Login To Join Discussion</a>
        </div>
    @elseif(Auth::user()->profile == null)
        <div class=btn-main>
            <a href="{{ route('profiles.create') }}" class="btn-text">Make Profile To Join Discussion</a>
        </div>
    @else
            <div class="form-container">
                <div class="form-top-section">
                    <textarea type="text" 
                        name="comment" 
                        rows="2" 
                        class="form-writing-section" placeholder="Write a comment..." required
                        wire:model="newComment"></textarea>
                </div>
                <div class="form-bottom-section">
                    <button wire:click="addComment" class="btn-main">
                        Post comment
                    </button>
                </div>
            </div>
    @endif
</div>
