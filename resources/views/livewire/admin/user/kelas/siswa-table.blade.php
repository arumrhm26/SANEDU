<div>
    <div class="p-4 font-semibold flex flex-row justify-between">
        <div class="flex items-center gap-3 ">
            <x-antdesign-user-o class="h-10 w-10" />
            <h3>
                Siswa
            </h3>
        </div>
        <div>
            <x-primary-button wire:click="$dispatch('open-modal', {
                                                component: 'tambah-siswa-kelas',
                                                classRoom: {{ $classRoom }},
                                            })"
                              class="text-sm">
                Tambah Siswa
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
                          wire:model.live="search"
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
                        No
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody>

                @forelse ($students as $student)
                    <tr class="odd:bg-white  even:bg-primary-50  border-b ">
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $loop->iteration }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $student->user->name }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            <div class="flex gap-1">
                                <a class="text-xs bg-primary-900 p-1 px-2 rounded text-white cursor-pointer"
                                   href="{{ route('admin.tahunajarankelas.kelas.siswa', [$tahunAjaran, $classRoom, $student]) }}"
                                   wire:navigate>
                                    Detail
                                </a>
                                <button class="text-xs bg-red-600 p-1 px-2 rounded text-white cursor-pointer"
                                        wire:click="deleteStudent({{ $student->id }})">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>

                @empty

                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="px-6 py-4"
                            colspan="3">
                            Tidak ada data
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

        {{-- Pagination --}}
        <div class="p-5">
            {{ $students->links() }}
        </div>

    </div>

    <livewire:modal.tambah-siswa-kelas />

</div>

