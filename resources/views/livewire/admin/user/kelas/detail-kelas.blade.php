<div>

    {{-- Header --}}
    <div class="flex gap-2">
        <h2 class="font-bold text-xl">
            {{ __($classRoom->full_name ?? '') }}
        </h2>
    </div>
    {{-- End Header --}}

    {{-- Tabs --}}

    <ul class="flex flex-wrap font-sm text-sm text-center border-b border-gray-200 mt-4">
        <li class="me-2">
            <a class="inline-block p-3 py-2 rounded-t-lg text-white cursor-pointer {{ $activeTab == 'siswa' ? 'bg-primary-950' : 'bg-gray-400' }}"
               wire:click="changeTab('siswa')">
                Siswa
            </a>
        </li>
        <li class="me-2">
            <a class="inline-block p-3 py-2 rounded-t-lg text-white cursor-pointer {{ $activeTab == 'mata-pelajaran' ? 'bg-primary-950' : 'bg-gray-400' }}"
               wire:click="changeTab('mata-pelajaran')">
                Mata Pelajaran
            </a>
        </li>
    </ul>

    {{-- End Tabs --}}

    {{-- Table --}}

    <div class="bg-primary-100 rounded-lg rounded-tl-none">

        @if ($activeTab == 'mata-pelajaran')
            <livewire:admin.user.kelas.mata-pelajaran-table :$classRoom
                                                            :$tahunAjaran />
        @else
            <livewire:admin.user.kelas.siswa-table :$classRoom
                                                   :$tahunAjaran />
        @endif

    </div>

    {{-- End Table --}}

</div>

