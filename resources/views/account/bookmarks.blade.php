<x-layout>
    <x-setting heading="Bookmarked posts">
        <div class="lg:grid lg:grid-cols-6">
            @foreach($bookmarks as $bookmark)
                <x-post-card class="col-span-3" :post="$bookmark->post" />
            @endforeach
        </div>
    </x-setting>
</x-layout>
