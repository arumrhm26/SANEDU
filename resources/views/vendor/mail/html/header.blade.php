@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}"
           style="display: inline-block;">
            @if (trim($slot) === 'Sanedu')
                <img src="{{ public_path('logo.png') }}"
                     class="logo"
                     alt="Sanedu">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>

