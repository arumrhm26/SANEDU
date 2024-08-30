<x-slot:header>
    <h2>
        {{ __('Progres Siswa') }}
    </h2>
</x-slot>

<div>
    <div class="bg-primary-100 rounded-lg mt-4">

        <div class="flex justify-between p-5">
            <h3 id="kelola-progres-siswa"
                class="font-semibold">Kelola Progres Siswa</h3>
            <x-primary-button class="flex items-center justify-center gap-3 text-sm"
                              wire:click="$dispatch('openModal', {
                                    component: 'modal.tambah-materi',
                                })">
                <x-antdesign-plus-o class="w-3 h-3" />
                Tambah Materi
            </x-primary-button>
        </div>

        <div class="flex flex-col gap-4 p-4 md:flex-row md:justify-between">
            <div class="flex items-center gap-2">
                <h4 class="font-semibold">Show</h4>
                <select id="small"
                        wire:model.live="perPage"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <p class="">entries</p>
            </div>
            <div class="flex items-center gap-2">
                <label for="search"
                       class="font-semibold">Search</label>
                <x-text-input id="search"
                              type="text"
                              placeholder="Search..."
                              size="sm"
                              wire:model.live="search" />
            </div>
        </div>

        <div class="flex gap-2 flex-col sm:flex-row p-4">
            <livewire:select2 name="tahun-ajaran"
                              :options="App\Models\TahunAjaran::all()"
                              wire:model.live='tahunAjaran'
                              :key="App\Models\TahunAjaran::all()->pluck('id')->join('-') . 'tahun-ajaran'" />

            @if ($tahunAjaran)
                <livewire:select2 name="grade"
                                  :options="App\Models\Grade::all()"
                                  wire:model.live='grade'
                                  :key="App\Models\Grade::all()->pluck('id')->join('-') . 'grade'" />
            @endif

            @if ($grade)
                <livewire:select2 name="kelas"
                                  :options="$classRooms"
                                  wire:model.live='classRoom'
                                  :key="$classRooms->pluck('id')->join('-') . 'kelas'" />
            @endif

            @if ($classRoom)
                <livewire:select2 name="mata-pelajaran"
                                  :options="$subjects"
                                  wire:model.live='subject'
                                  :key="$subjects->pluck('id')->join('-') . 'mata-pelajaran'" />
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="text-sm w-full text-left ">
                <thead class="text-sm bg-primary-200">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3">
                            No
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Materi
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Mata Pelajaran
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Kelas
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Jumlah Indikator
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($materis as $materi)
                        <tr
                            class="odd:bg-white  even:bg-primary-50  border-b ">
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $loop->iteration }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $materi->name }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $materi->subject->name }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $materi->subject->classRoom->full_name }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $materi->indikators_count }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                <div class="flex gap-2 items-center">
                                    <a class="text-xs bg-primary-900 p-1 px-2 rounded text-white cursor-pointer"
                                       href="{{ route('admin.kelola-progres.materi', $materi) }}"
                                       wire:navigate>
                                        Detail
                                    </a>
                                    <x-dropdown align="right"
                                                width="w-36">
                                        <x-slot name="trigger">
                                            <button
                                                    class=" text-xs p-1 px-2 rounded cursor-pointer bg-white ring-1 ring-zinc-700">
                                                Lainnya
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            <x-dropdown-link class="cursor-pointer"
                                                             wire:click="$dispatch('openModal', {
                                                                    component: 'modal.tambah-indikator',
                                                                    arguments: {
                                                                        selectedMateri: {{ $materi }},
                                                                    }
                                                                })">
                                                {{ __('Tambah Indikator') }}
                                            </x-dropdown-link>
                                            <x-dropdown-link class="cursor-pointer"
                                                             wire:click="$dispatch('openModal', {
                                                                        component: 'modal.edit-materi',
                                                                        arguments: {
                                                                            materi: {{ $materi }},
                                                                        }
                                                                    })">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>

                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td scope="col"
                                class="px-6 py-3"
                                colspan="5">
                                Data Tidak ditemukan
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            <div class="p-4">
                {{ $materis->links(
                    data: [
                        'scrollTo' => '#kelola-progres-siswa',
                    ],
                ) }}
            </div>
        </div>
    </div>

</div>

