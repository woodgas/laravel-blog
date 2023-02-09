@auth()
    <x-panel>
        <form method="POST" action="/post/{{$post->slug}}/comments">
            @csrf
            <header class="flex items-center">
{{--                TODO: Set the user avatar or default  --}}

                @if(auth()->user()->thumbnail ?? false)
                    <img src=" {{ asset('/storage/'.auth()->user()->thumbnail) }} " alt="Avatar" width="40" height="40" class="rounded-full">
                @else
                    <img src="https://i.pravatar.cc/60?img={{auth()->id()}}" alt="" width="40" height="40" class="rounded-full">
                @endif
                <h2 class="ml-4">
                    Want to participate?
                </h2>
            </header>
            <div class="mt-6">
                        <textarea name="body" rows="5" class="w-full border border-blue-300
                        p-2 text-sm focus:outline-none rounded-xl focus:ring
                        " placeholder="Quick, place something write!"
                                  required
                        ></textarea>
            <x-form.error name="body" />

            </div>
            <div class="flex justify-end">
            <x-form.button>Post</x-form.button>
            </div>
        </form>
    </x-panel>
@else
    <p class="font-semibold">
        Please <a href="/register" class="hover:underline">Register</a> or
        <a href="/login" class="hover:underline">Log In</a> to leave the comments!
    </p>
@endauth
