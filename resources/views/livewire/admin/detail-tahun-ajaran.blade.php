<div>
    <div class="flex gap-2">
        <h2 class="font-bold text-xl">
            {{ __($tahunAjaran->name) }}
        </h2>
    </div>

    <div class="flex justify-end mb-4">

        <x-primary-button class="flex items-center justify-center gap-3 text-sm"
                          wire:click="$dispatch('openModal', { 
                                        component: 'modal.tambah-kelas',
                                        arguments: {
                                            tahunAjaran: {{ $tahunAjaran }},
                                        }
                                    })">
            <x-antdesign-plus-o class="w-4 h-4" />
            Tambah Kelas
        </x-primary-button>

    </div>

    <div class="bg-primary-100 rounded-lg">

        <div class="flex items-center gap-3 p-4 font-semibold">
            <x-antdesign-user-o class="h-10 w-10" />
            <h3>
                Kelas
            </h3>
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

        <div class="overflow-x-auto ">
            <table class="w-full text-sm text-left rtl:text-right">
                <thead class="text-sm bg-primary-200">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3">
                            No
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Kelas
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Jumlah Siswa
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Limit Siswa
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Cabang
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="">

                    @forelse ($classRooms as $classRoom)
                        <tr wire:key="classRoom.{{ $classRoom->id }}"
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-primary-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $loop->iteration }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $classRoom->full_name }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $classRoom->students_count }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $classRoom->limit_siswa }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $classRoom->cabang->nama }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                <div class="flex gap-2 items-center">
                                    <a class="text-xs bg-primary-900 p-1 px-2 rounded text-white cursor-pointer"
                                       href="{{ route('admin.tahunajarankelas.kelas.show', [$tahunAjaran, $classRoom]) }}"
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
                                                             wire:click="$dispatch('open-modal', {'component': 'tambah-siswa-kelas', 'classRoom': {{ $classRoom }} })">
                                                {{ __('Tambah Siswa') }}
                                            </x-dropdown-link>
                                            <x-dropdown-link class="cursor-pointer"
                                                             wire:click="$dispatch('openModal', { 
                                                                    component: 'modal.edit-kelas',
                                                                    arguments: {
                                                                        classRoom: {{ $classRoom }},
                                                                    }
                                                                })">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                            <x-dropdown-link class="cursor-pointer"
                                                             wire:click="$dispatch('openModal', { 
                                                                component: 'modal.delete-kelas',
                                                                arguments: {
                                                                    classRoom: {{ $classRoom }},
                                                                }
                                                            })">
                                                {{ __('Hapus') }}
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-primary-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td scope="col"
                                class="px-6 py-3"
                                colspan="6">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

            {{-- Pagination --}}
            <div class="p-5">
                {{ $classRooms->links() }}
            </div>

        </div>

    </div>

    <livewire:modal.tambah-siswa-kelas />

</div>

