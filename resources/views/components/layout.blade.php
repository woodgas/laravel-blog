<!doctype html>

<title>Laravel Blog</title>
<link href="/css/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="/css/css2.css" rel="stylesheet">
<script defer src="/js/cdn.min.js"></script>

<style>
    html {
        scroll-behavior: smooth;
    }

</style>


<body style="font-family: Open Sans, sans-serif">

    <section class="px-6 py-0">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <img src="/images/logo.png" alt="Blog Logo" width="165">
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex items-center">

                @auth()

                    <x-dropdown>
                        <x-slot name="trigger">
                             <button class="text-s font-bold uppercase text-blue-600">Hello {{ auth()->user()->username }}!</button>
                        </x-slot>

                        <x-slot name="links">

                            <x-dropdown-item href="/account/edit"
                                             :active="request()->is('account/edit')"
                            >
                                My Account
                            </x-dropdown-item>

                            <x-dropdown-item href="/account/bookmarks"
                                             :active="request()->is('account/bookmarks')"
                            >
                                Bookmarks
                            </x-dropdown-item>


{{--                            @if(auth()->user()->can('admin'))--}}
{{--                            @can('admin')--}}
                            @admin

                                <x-dropdown-item href="/admin/posts/create"
                                :active="request()->is('admin/posts/create')"
                                >
                                    New Post
                                </x-dropdown-item>

                                <x-dropdown-item href="/admin/posts"
                                                 :active="request()->is('admin/posts')"
                                >
                                    Dashboard
                                </x-dropdown-item>

                            @endadmin
{{--                            @endcan--}}
{{--                            @endif--}}

                            <x-dropdown-item href="#"
                                             x-data="{}"
                                             @click.prevent="document.querySelector('#logout-form').submit()"
                            >
                                Log out
                            </x-dropdown-item>

                        </x-slot>

                    </x-dropdown>

                    <form id="logout-form" method="POST" action="/logout" hidden>
                        @csrf
                    </form>


                @else
                    <a href="/register" class="text-xs font-bold uppercase">Register</a>
                    <a href="/login" class="text-xs font-bold uppercase ml-3">Login</a>
                @endauth

                <a  href="#newsletter"  class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Subscribe for Updates
                </a>

            </div>
        </nav>

        <main class="max-w-6xl mx-auto mt-6 lg:mt-10 space-y-6">
                {{ $slot }}
        </main>
    <footer id="newsletter" class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
        <img src="/images/keep-in-touch.png" alt="Keep in touch" class="mx-auto -mb-0" style="width: 100px;">
        <h5 class="text-3xl">Stay in touch with the latest posts</h5>
        <p class="text-sm mt-3">Promise to keep the inbox clean. No spam.</p>

        <div class="mt-10">
            <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                <form method="POST" action="/newsletter" class="lg:flex text-sm">
                    @csrf
                    <div class="lg:py-3 lg:px-5 flex items-center">
                        <label for="email" class="hidden lg:inline-block">
                            <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                        </label>

                        <div>
                            <input id="email" name="email" type="text" placeholder="Your email address"
                               class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">
                            @error('email')
                            <span class="text-xs text-red-600  ">{{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit"
                            class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8"
                    >
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </footer>
</section>

<x-flash />

</body>
