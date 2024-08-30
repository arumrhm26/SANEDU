@props(['icon', 'href' => '#', 'slug'])

@php

    $active = request()->fullUrlIs(url($href));

    $active = $active || (isset($slug) && Str::startsWith(request()->url(), url('admin/' . $slug)));

@endphp

<li>
    <a {{ $slot == 'Dashboard' ? '' : 'wire:navigate' }}
       href="{{ $href }}"
       class="{{ $active ? 'bg-primary-800' : '' }} flex items-center p-2 text-white rounded-lg hover:bg-primary-800 group text-sm">
        @isset($icon)
            {{ $icon }}
        @endisset
        <span class="ms-3">
            {{ $slot }}
        </span>
    </a>
</li>

