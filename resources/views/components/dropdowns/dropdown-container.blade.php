<div {{ $attributes->merge(['class' => 'absolute z-10 divide-y divide-gray-100 rounded-lg shadow-lg w-44 transition-all']) }}
     x-show="open"
     @click.outside="open = false"
     x-transition
     x-cloak>
    <ul class="py-2 text-sm text-gray-700">
        {{ $slot }}
    </ul>
</div>

