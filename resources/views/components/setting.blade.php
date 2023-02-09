@props(['heading'])

<section class="py-8 max-w-5xl mx-auto">

    <h1 class="text-center text-xl font-bold text-gray-800 mb-8 pb-2 border-b">
        {{ $heading }}
    </h1>

    <div class="flex">
        <aside class="w-32 flex-shrink-0">
            <h4 class="font-semibold mb-4">Links</h4>
            <ul>

                <li class="mb-2">
                    <a href="/account/edit" class="{{
                    request()->is('account/edit') ? 'text-blue-500 font-semibold': ''
                    }}"
                    >
                        My Account
                    </a>
                </li>


                <li class="mb-2">
                    <a href="/account/bookmarks" class="{{
                    request()->is('account/bookmarks') ? 'text-blue-500 font-semibold': ''
                    }}"
                    >
                        Bookmarks
                    </a>
                </li>

                @admin
                <li class="mb-2">
                    <a href="/admin/posts/create" class="{{
                    request()->is('admin/posts/create') ? 'text-blue-500 font-semibold': ''
                    }}"
                    >
                        New Post
                    </a>
                </li>

                <li class="mb-2">
                    <a href="/admin/posts" class="{{
                    request()->is('admin/posts') ? 'text-blue-500 font-semibold': ''
                    }}"
                    >
                        Dashboard
                    </a>
                </li>
                @endadmin

            </ul>
        </aside>

        <main class="flex-1">
            <x-panel>
                {{ $slot }}
            </x-panel>
        </main>
    </div>
</section>
