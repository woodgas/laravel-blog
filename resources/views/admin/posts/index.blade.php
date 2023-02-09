<x-layout>

    <x-setting heading="Manage Posts">

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">

                            <tr class="bg-gray-200 border-b-2 border-gray-300">
                                <th class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-s font-medium font-bold text-gray-900">
                                            Date/Views
                                        </div>
                                    </div>
                                </th>

                                <th class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-s font-medium font-bold text-gray-900">
                                            Author
                                        </div>
                                    </div>
                                </th>

                                <th class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-s font-medium font-bold text-gray-900">
                                            Title
                                        </div>
                                    </div>
                                </th>

                                <th class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-s font-medium font-bold text-gray-900">
                                            Status
                                        </div>
                                    </div>
                                </th>

                                <th class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-s font-medium font-bold text-gray-900">
                                            Edit
                                        </div>
                                    </div>
                                </th>

                                <th class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-s font-medium font-bold text-gray-900">
                                            Delete
                                        </div>
                                    </div>
                                </th>
                            </tr>

                            @foreach ($posts as $post)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $post->created_at->toDateString() }}
                                                <br/>
                                                {{ $post->created_at->toTimeString('minute') }}
                                                <br/>
                                                <span class="text-m text-blue-600">&#128065</span>
                                                {{ $post->views_count }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="/?author={{ $post->author->name }}">
                                                    {{ $post->author->name }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="/post/{{ $post->slug }}">
                                                    {!! wordwrap($post->title, 35, "<br/>")  !!}
                                                </a>
                                            </div>
                                        </div>
                                    </td>


                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="
                                            text-sm font-medium text-gray-900
                                            {{ $post->status=='published'? 'bg-green-300' : 'bg-red-300'
                                            }}
                                            p-1
                                            rounded-lg
                                            ">
                                                {{ $post->status }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/admin/posts/{{ $post->id }}/edit" class="text-blue-500 hover:text-blue-600">Edit</a>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form method="POST" action="/admin/posts/{{ $post->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-xs text-gray-400">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </x-setting>

</x-layout>





{{--<x-layout>--}}

{{--    @include("posts.header")--}}

{{--    @if(isset($posts[0]))--}}
{{--        <div class="lg:grid lg:grid-cols-6">--}}
{{--            @foreach($posts as $post)--}}
{{--                <x-post-card class="col-span-2" :post="$post" />--}}
{{--            @endforeach--}}
{{--        </div>--}}

{{--        {{ $posts->onEachSide(3)->links() }}--}}
{{--    @else--}}
{{--        <p class="text-center mb-0">There are no posts.</p>--}}
{{--    @endif--}}
{{--</x-layout>--}}
