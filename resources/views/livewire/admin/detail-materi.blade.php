<div>

    <h2 class="font-bold text-xl">
        {{ __('Progres Siswa') }}
    </h2>

    <div class="bg-primary-100 rounded-lg mt-4">
        <div class="flex items-center justify-between gap-3 p-4 font-semibold">
            <div class="flex gap-3 flex-col">
                <table>
                    <tr>
                        <td>Mata Pelajaran</td>
                        <td>:</td>
                        <td>{{ $materi->subject->name }}</td>
                    </tr>
                    <tr>
                        <td>Materi</td>
                        <td>:</td>
                        <td>{{ $materi->name }}</td>
                    </tr>
                </table>
            </div>
            <div>
                <x-primary-button wire:click="$dispatch('openModal', {
                                                component: 'modal.tambah-indikator',
                                                arguments: {
                                                    selectedMateri: {{ $materi }},
                                                }
                                            })"
                                  class="text-sm bg-green-500 hover:bg-green-600">
                    Tambah Indikator
                </x-primary-button>

            </div>
        </div>

        <div class="flex flex-col gap-4 p-4 md:flex-row md:justify-between">
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

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right ">
                <thead class="text-sm bg-primary-200">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 w-16">
                            Kode
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Indikator
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($indikators as $indikator)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-primary-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $indikator?->code ?? '-' }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $indikator->name }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                <div class="flex gap-1 items-center">
                                    <button class="text-xs bg-primary-900 p-1 px-2 rounded text-white"
                                            wire:click="$dispatch('openModal', { 
                                                            component: 'modal.detail-indikator',
                                                            arguments: { 
                                                                indikator: {{ $indikator }}
                                                            }
                                                        })">
                                        Detail
                                    </button>
                                    <button class="text-xs bg-positive p-1 px-2 rounded text-white"
                                            wire:click="$dispatch('openModal', {
                                                            component: 'modal.edit-indikator',
                                                            arguments: {
                                                                indikator: {{ $indikator }},
                                                            }
                                                        })">
                                        Edit
                                    </button>
                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr class="bg-white">
                            <td class="px-6 py-4"
                                colspan="3">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

            {{-- Pagination --}}
            <div class="p-5">
                {{ $indikators->links(
                    data: [
                        'scrollTo' => false,
                    ],
                ) }}
            </div>

        </div>
    </div>

</div>
