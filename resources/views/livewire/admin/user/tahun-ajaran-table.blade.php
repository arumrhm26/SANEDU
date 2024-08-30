<x-slot:header>
    <h2>
        {{ __('User') }}
    </h2>
</x-slot>
<div class="">

    <div class="flex justify-end mb-4">
        <x-primary-button class="flex items-center justify-center gap-3 text-sm"
                          wire:click="$dispatch('openModal', { 
                                        component: 'modal.tambah-tahun-ajaran',
                                    })">
            <x-antdesign-plus-o class="w-3 h-3" />
            Tambah tahun ajaran

            <div wire:loading>
                Saving post...
            </div>
        </x-primary-button>

    </div>
    <div class="bg-primary-100 rounded-lg">
        <div class="flex items-center gap-3 p-4 font-semibold">
            <x-antdesign-user-o class="h-10 w-10" />
            <h3>
                Tahun Ajaran
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
            <table class="text-sm w-full text-left">
                <thead class="text-sm bg-primary-200">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3">
                            No
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Tahun Ajaran
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Tanggal Mulai
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Tanggal Berakhir
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Aksi
                        </th>

                    </tr>
                </thead>
                <tbody>

                    @forelse($this->tahunAjarans as $tahunAjaran)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-primary-50 ">
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $loop->iteration }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $tahunAjaran->name }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $tahunAjaran->mulai }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                {{ $tahunAjaran->selesai }}
                            </td>
                            <td scope="col"
                                class="px-6 py-3">
                                <div class="flex items-center gap-1">
                                    <a class="text-xs bg-primary-900 p-1 px-2 rounded text-white cursor-pointer"
                                       wire:navigate
                                       href="{{ route('admin.tahunajarankelas.show', $tahunAjaran) }}">
                                        Detail
                                    </a>
                                    <x-dropdown align="right"
                                                width="w-36">
                                        <x-slot name="trigger">
                                            <button
                                                    class="text-xs p-1 px-2 rounded cursor-pointer bg-white ring-1 ring-zinc-700">
                                                Lainnya
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">

                                            <x-dropdown-link class="cursor-pointer"
                                                             wire:click="$dispatch('openModal', { 
                                                component: 'modal.import-data-tahun-ajaran',
                                                arguments: { 
                                                    tahunAjaran: {{ $tahunAjaran }}
                                                }
                                            })">
                                                {{ __('Import Data') }}
                                            </x-dropdown-link>

                                            <x-dropdown-link class="cursor-pointer"
                                                             wire:click="$dispatch('openModal', { 
                                                component: 'modal.edit-tahun-ajaran',
                                                arguments: { 
                                                    tahunAjaran: {{ $tahunAjaran }}
                                                }
                                            })">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>

                                            <x-dropdown-link class="cursor-pointer"
                                                             wire:click="$dispatch('openModal', { 
                                                    component: 'modal.delete-tahun-ajaran',
                                                    arguments: { 
                                                        tahunAjaran: {{ $tahunAjaran }}
                                                    }
                                                })">
                                                {{ __('Delete') }}
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
                                Tidak ada data
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            <div class="flex justify-between p-4">
                {{ $this->tahunAjarans->links() }}

            </div>
        </div>
    </div>

</div>

