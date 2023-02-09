<x-layout>

    @include("posts.header")

    @if(isset($posts[0]))
        <x-featured-post :post="$posts[0]" />
             <div class="lg:grid lg:grid-cols-6">
                @foreach($posts->skip(1) as $post)
                <x-post-card class="col-span-{{ $loop->iteration > 2 ? 2 : 3}}" :post="$post" />
                @endforeach
            </div>

        {{ $posts->onEachSide(3)->links() }}
    @else
        <p class="text-center mb-0">There are no posts.</p>
    @endif
</x-layout>
