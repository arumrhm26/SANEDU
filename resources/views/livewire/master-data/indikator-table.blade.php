<div class="bg-primary-100 rounded-lg">
    <div class="flex items-center justify-between gap-3 p-4 font-semibold">
        <div class="flex items-center gap-3 ">
            <x-antdesign-user-o class="h-10 w-10" />
            <h3>
                Indikator Materi
            </h3>
        </div>
        <div>
            <x-primary-button wire:click="$dispatch('openModal', {
                                                component: 'modal.tambah-indikator',
                                            })"
                              class="text-sm bg-green-500 hover:bg-green-600">
                Buat Indikator
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
                        class="px-6 py-3">
                        Kode
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Nama Indikator
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Nama Materi
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Nama Mata Pelajaran
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Kelas
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
                            {{ $indikator->code ?? '-' }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $indikator->name }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $indikator->materi->name }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $indikator->materi->subject->name }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $indikator->materi->subject->classRoom->name ?? '' }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            <button class="text-xs bg-positive p-1 px-2 rounded text-white">
                                Edit
                            </button>
                            <button class="text-xs bg-red-600 p-1 px-2 rounded text-white">
                                Delete
                            </button>
                        </td>
                    </tr>

                @empty

                    <tr class="bg-white">
                        <td class="px-6 py-4"
                            colspan="6">
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

