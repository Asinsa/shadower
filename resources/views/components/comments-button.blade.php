<div class="mt-4 btn-comment">
    <svg aria-hidden="true" class="w-6 h-6 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
    <a href="{{ route($route, ['id' => $item->id]) }}#comments">Comments</a>
    <span class="inline-flex items-center justify-center w-5 h-5 ml-2 text-s font-semibold text-blue-800 bg-blue-200 rounded-full">
        {{ DB::table('interactions')->where('post_id', $item->id)->where('interaction_type', 'comment')->count(); }}
    </span>
</div>