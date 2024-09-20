<x-slot:header>
    <h2>
        {{ __('Absensi') }}
    </h2>
</x-slot>

<div>

    {{-- Start Tabs --}}
    <ul class="flex flex-wrap font-sm text-sm text-center border-b border-gray-200 mt-4">
        <li class="me-2">
            <a class="inline-block p-3 py-2 rounded-t-lg text-white cursor-pointer bg-primary-950">
                Pertemuan
            </a>
        </li>
        <li class="me-2">
            <a class="inline-block p-3 py-2 rounded-t-lg text-white bg-gray-400"
               href="{{ route('admin.absen.rekapan') }}">
                Rekapan
            </a>
        </li>
    </ul>
    {{-- End Tabs --}}

    {{-- Start Table --}}
    <div class="bg-primary-100 rounded-lg rounded-tl-none">

        <livewire:admin.absen.pertemuan-absen />

    </div>

</div>

