<x-user-layout>
    <div class="min-h-screen max-w-screen-lg mx-auto sm:pt-12">

        {{-- Header --}}
        <x-user.header />
        {{-- End Header --}}

        {{-- Menu --}}
        @role('siswa')
            <x-user.menu.siswa />
        @endrole
        @role('guru')
            <x-user.menu.guru />
        @endrole
        @role('orangtua')
            <x-user.menu.orang-tua />
        @endrole
        {{-- End Menu --}}

        {{-- Chart --}}

        @role('siswa')
            <livewire:user.siswa.chart-siswa />
        @endrole

        {{-- End Chart --}}

    </div>
</x-user-layout>

