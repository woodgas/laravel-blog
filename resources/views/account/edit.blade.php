<x-layout>
    <x-setting heading="Edit Account Data">

        <form action="/account/edit" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.input name="name" value="{{ old('user', $user->name) }}"/>

            <x-form.input name="username" value="{{ old('username', $user->username) }}"/>

            <x-form.input type="password" name="password" value="{{ old('password') }}"/>

            <div class="flex">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $user->thumbnail)" />
                </div>
                    <x-avatar :thumbnail="$user->thumbnail" class="object-none ml-4 " />
                </div>

            </div>

            <x-form.button>Update</x-form.button>

        </form>

    </x-setting>
</x-layout>
