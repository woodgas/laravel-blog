<x-layout>

        <main class="max-w-lg mx-auto bg-gray-100 p-6 rounded-xl border border-gray-400">

            <h1 class="text-center text-xl font-bold text-gray-800">Please register</h1>
            <form method="POST" action="/register" class="mt-10">
                @csrf
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-grey-700"
                           for="name"
                    >
                        Name
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="text"
                           name="name"
                           id="name"
                           required
                           value="{{ old('name') }}"
                    >
                    @error('name')
                    <p class="text-red-500 text-xs mt-1"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-grey-700"
                           for="username"
                    >
                        UserName
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="text"
                           name="username"
                           id="username"
                           required
                           value="{{ old('username') }}"
                    >
                    @error('username')
                    <p class="text-red-500 text-xs mt-1"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-grey-700"
                           for="email"
                    >
                        Email
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="email"
                           name="email"
                           id="email"
                           required
                           value="{{ old('email') }}"
                    >
                    @error('email')
                    <p class="text-red-500 text-xs mt-1"> {{ $message }} </p>
                    @enderror
                </div>


                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-grey-700"
                           for="password"
                    >
                        Password
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="password"
                           name="password"
                           id="password"
                           required
                    >
                    @error('password')
                    <p class="text-red-500 text-xs mt-1"> {{ $message }} </p>
                    @enderror

                </div>

                <div class="mb-6">
                    <button type="submit"
                            class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                    >
                     Submit
                    </button>

                </div>
{{--                @if($errors->any())--}}
{{--                    <ul>--}}
{{--                        @foreach($errors->all() as $error)--}}

{{--                            <li class="text-red-500 text-xs">--}}
{{--                            {{ $error }}--}}
{{--                            </li>--}}

{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                @endif--}}
            </form>
        </main>
</x-layout>
