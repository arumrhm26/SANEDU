<div>

    {{-- Start Progress Siswa --}}

    <div class="bg-primary-100 rounded-lg mt-4">

        <div class="p-4">

            <h3 class="font-semibold text-xl"
                id="progres-siswa">Progres Siswa</h3>

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
                            Indikator
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Nilai
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($studentIndikators as $studentIndikator)
                        <tr class="odd:bg-white even:bg-primary-50 border-b ">
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $loop->iteration }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $studentIndikator->indikator->materi->subject->name }} |
                                {{ $studentIndikator->indikator->materi->name }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $studentIndikator->indikator->name }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $studentIndikator->nilai }}
                            </td>

                            <td scope="col"
                                class="px-6 py-3">
                                <div class="flex gap-1">
                                    <button class="text-xs bg-primary-900 p-1 px-2 rounded text-white cursor-pointer"
                                            wire:click="$dispatch('open-modal', { component: 'edit-progres-siswa', studentIndikator: {{ $studentIndikator }}})">
                                        Edit
                                    </button>
                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr class="odd:bg-white even:bg-gray-50">
                            <td class="px-6 py-4"
                                colspan="5">
                                Tidak ada data
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

            {{-- Pagination --}}
            <div class="p-5">
                {{ $studentIndikators->links(
                    data: [
                        'scrollTo' => '#progres-siswa',
                    ],
                ) }}
            </div>

        </div>

        {{-- End Table --}}
    </div>
    {{-- End Progres Siswa --}}

    {{-- Modal --}}
    <livewire:modal.edit-progres-siswa />
    {{-- End Modal --}}

</div>

