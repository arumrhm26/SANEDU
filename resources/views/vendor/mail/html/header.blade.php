@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}"
           style="display: inline-block;">
            @if (trim($slot) === 'Sanedu')
                <img src="{{ asset('logo.png') }}"
                     class="logo"
                     alt="Laravel Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>

