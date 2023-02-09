@if(session()->has('success'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout( () => show = false, 4000)"
        x-show="show"
        class="fixed right-0 bg-blue-500 text-white py-2 px-4 rounded-3xl bottom-3">
        <p>{{ session('success') }}
            <button @click="show = false" class="text-xl"> [ X ] </button>
        </p>
    </div>
@endif

