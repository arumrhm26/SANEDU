@props(['type' => 'submit'])

@if ($type === 'link')
    <a
       {{ $attributes->merge(['class' => 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-md px-5 py-2.5 ']) }}>
        {{ $slot }}
    </a>
@else
    <button
            {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-md px-5 py-2.5 ']) }}>
        {{ $slot }}
    </button>
@endif

