<div>

    {{-- Start Progress Siswa --}}

    <div class="bg-primary-100 rounded-lg mt-4">

        <div class="p-4">

            <h3 class="font-semibold text-xl"
                id="absen-siswa">Absen Siswa</h3>

            <div class="flex flex-col gap-4 md:flex-row md:justify-between mt-8">
                <div class="flex items-center gap-2">
                    <h4 class="font-semibold">Show</h4>
                    <select wire:model.live="perPage"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                    </select>
                    <p class="">entries</p>
                </div>
                <div class="flex items-center gap-2">
                    <label for="search"
                           class="font-semibold">Search</label>
                    <x-text-input id="search"
                                  type="text"
                                  name="search"
                                  wire:model.live.debounce.500ms="search"
                                  placeholder="Search..."
                                  size="sm" />
                </div>
            </div>

        </div>

        {{-- Start Table --}}

        <div class="overflow-x-auto mt-2">
            <table class="w-full text-sm text-left rtl:text-right min-w-max">
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
                            Tanggal
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Jam Mulai
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Jam Masuk
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($pertemuanStudents as $pertemuanStudent)
                        <tr class="odd:bg-white even:bg-primary-50 border-b ">
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $loop->iteration }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $pertemuanStudent->pertemuan->materi->name ?? '-' }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $pertemuanStudent->pertemuan->tanggal->format('d M Y') ?? '-' }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $pertemuanStudent->pertemuan->waktu_mulai ?? '-' }}
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
                                <button class="text-xs bg-primary-900 p-1 px-2 rounded text-white"
                                        wire:click="$dispatch('open-modal', {'component': 'edit-absen-siswa', 'pertemuanStudent': {{ $pertemuanStudent }} })">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td scope="col"
                                class="px-6 py-3"
                                colspan="7">
                                <p class="text-center">Data tidak ditemukan</p>
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

            {{-- Pagination --}}
            <div class="p-5">
                {{ $pertemuanStudents->links() }}
            </div>

        </div>

        {{-- End Table --}}
    </div>
    {{-- End Progres Siswa --}}

    {{-- modal --}}
    <livewire:modal.edit-absen-siswa />
    {{-- end modal --}}
</div>

