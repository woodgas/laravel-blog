@props(['uri'])


    <x-dropdown>

        <x-slot name="trigger">
            <button class="bg-transparent py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex"
            >
                {{ isset($currentCategory) ? ucwords($currentCategory->slug) : 'Categories'
                 }}
                <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;"/>
            </button>
        </x-slot>

        <x-slot name="links">

            <x-dropdown-item
                href="?{{ http_build_query(request()->except('category','page')) }}"
                :active="request()->routeIs('home')"
            >
                All categories
            </x-dropdown-item>

        @foreach($categories as $category)

                <x-dropdown-item
                    href="?{{ http_build_query(array_merge((request()->except('category','page')), ['category' => $category->slug] )) }}"
                    :active="request()->is('categories/' . $category->slug )"
                >
                    {{ ucwords($category->name) }}

                </x-dropdown-item>
            @endforeach
        </x-slot>

    </x-dropdown>

