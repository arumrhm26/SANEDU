<div class="absolute top-10 z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 transition-all"
     x-show="dropdown"
     @click.outside="dropdown = false"
     x-transition
     x-cloak>
    <ul class="py-2 text-sm text-gray-700">
        {{ $slot }}
    </ul>
</div>

