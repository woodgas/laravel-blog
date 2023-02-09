<x-panel class="bg-gray-50">
<article class="flex space-x-4">
    <div class="flex-shrink-0">

        @if(auth()->user()->thumbnail ?? false)
            <img src=" {{ asset('/storage/'.auth()->user()->thumbnail) }} " alt="Avatar" width="40" height="40" class="rounded-full">
        @else
            <img src="https://i.pravatar.cc/60?img={{auth()->id()}}" alt="" width="40" height="40" class="rounded-full">
        @endif

    </div>

    <div>
        <header class="mb-4">
            <h3 class="font-bold">{{ $comment->author->name }}</h3>
            <p class="text-xs">
                Posted
                <time> {{ $comment->created_at->format('M, Y, g:i a') }}</time>
            </p>
        </header>
        <p>
            {!! $comment->body !!}
        </p>
    </div>
</article>
</x-panel>
