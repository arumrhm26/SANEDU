@props(['href' => '#', 'slug' => null])

@php

    $active = request()->fullUrlIs(url($href));

    $active = $active || (isset($slug) && Str::startsWith(request()->url(), url('admin/' . $slug)));

@endphp

<li x-cloak>
    <a wire:navigate
       href="{{ $href }}"
       class="{{ $active ? 'bg-primary-800' : '' }} flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-primary-800 text-sm">
        {{ $slot }}
    </a>
</li>
