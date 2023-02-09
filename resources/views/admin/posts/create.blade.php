@php
    $statuses = [
    'draft',
    'published'
];
@endphp

<x-layout>

    <x-setting heading="Publish New Post">
        <form action="/admin/posts" method="POST" enctype="multipart/form-data">
            @csrf

            <x-form.input name="title" :value="old('title')" required />
            <x-form.input name="slug" :value="old('slug')" required />
            <x-form.input name="thumbnail" type="file" required />

            <x-form.textarea name="excerpt" required />
            <x-form.textarea name="body" required />


            <x-form.field>
                <x-form.label name="status"/>
{{--             TODO   Make a separated select blade component? --}}
                <select name="status" id="status">

                    @foreach($statuses as $status)
                        <option value="{{ $status }}"
                            {{ old('status') == $status ? 'selected': '' }}
                        >{{ ucfirst($status) }}</option>
                    @endforeach

                </select>
                <x-form.error name="status"/>
            </x-form.field>

            <x-form.field>
                <x-form.label name="category" />

                <select name="category_id" id="category_id">

                    @foreach(App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected': '' }}
                        >{{ $category->name }}</option>
                    @endforeach

                </select>
                <x-form.error name="category_id"/>
            </x-form.field>

            <x-form.button>Publish or Save</x-form.button>

        </form>
    </x-setting>

</x-layout>
