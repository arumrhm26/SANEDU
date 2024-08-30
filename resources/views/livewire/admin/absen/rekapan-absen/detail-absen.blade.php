<x-slot:header>
    <h2>
        {{ __('Absensi') }}
    </h2>
</x-slot>

<div>

    {{-- Start Tabs --}}
    <ul class="flex flex-wrap font-sm text-sm text-center border-b border-gray-200 mt-4">
        <li class="me-2">
            <a class="inline-block p-3 py-2 rounded-t-lg text-white cursor-pointer bg-gray-400"
               wire:navigate
               href="{{ route('admin.absen') }}">
                Pertemuan
            </a>
        </li>
        <li class="me-2">
            <div class="inline-block p-3 py-2 rounded-t-lg text-white bg-primary-950">
                Rekapan
            </div>
        </li>
    </ul>
    {{-- End Tabs --}}

    <div class="bg-primary-100 rounded-lg pt-5">

        <div class="px-4 flex justify-between items-start">
            <h3 class="font-bold text-xl">Rekapan</h3>

            <div class="flex gap-1">
                <button class="bg-positive px-5 py-2 text-white rounded shadow"
                        wire:click="exportPDF">
                    PDF
                </button>
                <button class="bg-positive px-5 py-2 text-white rounded shadow"
                        wire:click="exportExcel">
                    Excel
                </button>
            </div>

        </div>

        <div class="flex flex-col gap-4 p-4 md:flex-row md:justify-between">
            <div class="flex items-center gap-2">
                <h4 class="font-semibold">Show</h4>
                <select id="small"
                        wire:model.live = 'perPage'
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                </select>
                <p class="">entries</p>
            </div>
            <div class="flex items-center gap-2">
                <label for="search"
                       class="font-semibold">Search</label>
                <x-text-input id="search"
                              type="text"
                              placeholder="Search..."
                              wire:model.live='search'
                              size="sm" />
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="text-sm min-w-max w-full text-left">
                <thead class="text-sm bg-primary-200">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Kelas
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Waktu Hadir
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Mata Pelajaran
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Materi
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Tutor
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody wire:poll>
                    @forelse ($pertemuanStudents as $pertemuanStudent)
                        <tr class="odd:bg-white  even:bg-primary-50  border-b ">
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $pertemuanStudent->student->user->name ?? '-' }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $pertemuanStudent->pertemuan->materi->subject->classRoom->full_name ?? '-' }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $pertemuanStudent->jam_masuk ?? '-' }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                <x-chip-absen status="{{ $pertemuanStudent->pertemuanStatus->name }}" />
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $pertemuanStudent->pertemuan->materi->subject->name ?? '-' }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $pertemuanStudent->pertemuan->materi->name ?? '-' }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $pertemuanStudent->pertemuan->materi->subject?->teacher->user->name ?? '-' }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                <div class="flex gap-2">
                                    <button class="text-xs bg-primary-900 p-1 px-2 rounded text-white"
                                            wire:click="$dispatch('open-modal', {'component': 'edit-absen-siswa', 'pertemuanStudent': {{ $pertemuanStudent }} })">
                                        Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white">
                            <td class="px-6 py-4"
                                colspan="8">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            <div class="p-4">
                {{ $pertemuanStudents->links() }}
            </div>
        </div>

    </div>

    {{-- modal --}}
    <livewire:modal.edit-absen-siswa />
    {{-- end modal --}}

</div>

