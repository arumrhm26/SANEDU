@props(['status' => 'Tidak hadir'])

@php

    $status = strtolower($status);

    $colorContainer = match ($status) {
        'hadir' => 'bg-blue-50 text-blue-600 ring-blue-600',
        'terlambat' => 'bg-red-50 text-red-600 ring-red-600',
        'izin' => 'bg-yellow-50 text-yellow-500 ring-yellow-300',
        default => 'bg-gray-50 text-gray-600 ring-gray-600',
    };

    $dotClass = match ($status) {
        'hadir' => 'bg-blue-600',
        'terlambat' => 'bg-red-600',
        'izin' => 'bg-yellow-300',
        default => 'bg-gray-600',
    };

@endphp

<span {{ $attributes->merge([
    'class' => 'p-1 px-4 pl-2 rounded-full ring-1 ' . $colorContainer,
]) }}>
    <span class="inline-flex rounded-full h-3 w-3 {{ $dotClass }}"></span>
    {{ Str::title($status) }}
</span>

