@props(['href' => '#'])

@php

    $class = request()->fullUrlIs(url($href))
        ? 'inline-block p-3 py-2 rounded-t-lg bg-primary-950 text-white'
        : 'inline-block p-4 py-2 rounded-t-lg  bg-gray-300 text-black';

@endphp

<li class="me-2">
    <a {{ $attributes->merge([
        'class' => $class,
        'href' => $href,
    ]) }}>
        {{ $slot }}
    </a>
</li>

