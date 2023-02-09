<x-layout>

    <x-setting :heading="'Edit The Post: '.$post->title">
        <form action="/admin/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" :value=" old('title', $post->title)" />
            <x-form.input name="slug" :value=" old('slug', $post->slug)" />

            <div class="flex">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)" />
                </div>
                <img src="{{ asset('/storage/'.$post->thumbnail) }}" width="100"  alt="" class="rounded-xl ml-4">
            </div>

            <x-form.textarea name="excerpt"> {{ old('excerpt', $post->excerpt) }}</x-form.textarea>
            <x-form.textarea name="body">{{ old('body', $post->body) }}</x-form.textarea>

            <x-form.field>
                <x-form.label name="status"/>
                {{--             TODO   Make a separated select blade component? --}}

                <select name="status" id="status">

                    @foreach(['draft', 'published'] as $status)
                        <option value="{{ $status }}"
                            {{ old('status', $post->status) == $status ? 'selected': '' }}
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
                            {{ old('category_id', $post->category_id) ==
                               $category->id ? 'selected': '' }}
                        >{{ $category->name }}</option>
                    @endforeach

                </select>
                <x-form.error name="category_id"/>
            </x-form.field>

            <x-form.field>
                <x-form.label name="author" />

                <select name="user_id" id="user_id">

                    @foreach(App\Models\User::orderBy('name')->get() as $author)

                        <option value="{{ $author->id }}"
                            {{ old('user_id', $post->author->id) ==
                               $author->id ? 'selected': '' }}
                        >{{ $author->name }}</option>
                    @endforeach

                </select>
                <x-form.error name="user_id"/>
            </x-form.field>


            <x-form.button>Update</x-form.button>

        </form>
    </x-setting>

</x-layout>
