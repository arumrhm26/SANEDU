@props([
    'disabled' => false,
    'size' => 'md',
    'type' => null,
])

@php
    $classes = [
        'sm' => 'p-1.5 text-sm',
        'md' => 'p-2.5 text-sm',
        'lg' => 'p-3 text-base',
    ];
@endphp

@if ($type === 'password')
    <div class="relative">
        <input {{ $disabled ? 'disabled' : '' }}
               {!! $attributes->merge([
                   'class' =>
                       'bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ' .
                       $classes[$size],
                   'placeholder' => $attributes['placeholder'] ?? Str::title($attributes['name']),
                   'autocomplete' => $attributes['autocomplete'] ?? 'off',
                   'type' => 'password',
                   'id' => $attributes['id'],
                   'onfocus' => 'this.value = this.value;',
               ]) !!} />
        <div class="absolute top-3 right-4 cursor-pointer"
             id="show-{{ $attributes['id'] }}-btn">
            <x-antdesign-eye-o class="w-5 h-5"
                               id="show-{{ $attributes['id'] }}" />
            <x-antdesign-eye-invisible-o class="w-5 h-5 hidden"
                                         id="hide-{{ $attributes['id'] }}" />
        </div>

    </div>
@else
    <input {{ $disabled ? 'disabled' : '' }}
           {!! $attributes->merge([
               'class' =>
                   'bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ' .
                   $classes[$size],
               'placeholder' => $attributes['placeholder'] ?? Str::title($attributes['name']),
               'autocomplete' => $attributes['autocomplete'] ?? 'off',
               'type' => $type ?? 'text',
           ]) !!} />
@endif

@pushIf($type === 'password', 'scripts')
<script>
    document.getElementById("show-{{ $attributes['id'] }}-btn").addEventListener('click', (e) => {
        e.preventDefault();

        // document.getElementById('{{ $attributes['id'] }}').focus();
        if (document.getElementById("{{ $attributes['id'] }}").type === 'password') {
            document.getElementById("{{ $attributes['id'] }}").type = 'text';
            document.getElementById("show-{{ $attributes['id'] }}").style.display = 'none';
            document.getElementById("hide-{{ $attributes['id'] }}").style.display = 'block';
        } else {
            document.getElementById("{{ $attributes['id'] }}").type = 'password';
            document.getElementById("show-{{ $attributes['id'] }}").style.display = 'block';
            document.getElementById("hide-{{ $attributes['id'] }}").style.display = 'none';
        }
    });
</script>
@endPushIf

