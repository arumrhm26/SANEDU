@props(['id', 'trigger'])

<button x-data="{ open: false }"
        @click="open = !open"
        {{ $attributes->merge([
            'class' => 'text-xs bg-white ring-zinc-600 ring-1 p-1 px-2 rounded cursor-pointer',
        ]) }}>
    {{ $trigger ?? 'Lainnya' }}
    <ul x-show="open"
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        style="display: none;"
        id="children.{{ $id }}"
        class="absolute z-10 min-w-32 py-1 bg-white rounded shadow-lg top-0 left-0 ">
        {{ $slot }}
    </ul>
</button>

