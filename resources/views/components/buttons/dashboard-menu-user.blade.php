@props(['icon'])

<a {{ $attributes->merge([
    'class' => 'text-center flex flex-col items-center max-w-40 cursor-pointer',
]) }}>

    @isset($icon)
        {{ $icon }}
    @endisset

    <span class="font-semibold break-words">{{ $slot }}</span>
</a>

