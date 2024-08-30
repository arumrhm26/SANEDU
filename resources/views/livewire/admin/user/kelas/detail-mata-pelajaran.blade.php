<div>

    <h2 class="font-semibold text-2xl">{{ $subject->name }} | {{ $classRoom->full_name }} |
        {{ $tahunAjaran->name }}
    </h2>

    <div class="bg-primary-100 rounded-lg mt-4">

        <div class="p-4">

            <div class="flex justify-between">
                <h3 class="font-semibold text-xl"
                    id="progres-siswa">Materi</h3>

                <x-primary-button wire:click="$dispatch('openModal', {
                        component: 'modal.tambah-materi-subject',
                        arguments: {
                            subject: {{ $subject }},
                        }
                    })"
                                  class="text-sm bg-primary-800">
                    Tambah Materi
                </x-primary-button>

            </div>

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
            <table class="min-w-max w-full text-sm text-left table-auto">
                <thead class="text-sm bg-primary-200">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 w-3">
                            No
                        </th>
                        <th scope="col"
                            class="px-6 py-3 w-[800px]">
                            Materi
                        </th>

                        <th scope="col"
                            class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                @forelse ($materis as $materi)

                    <tr class="odd:bg-white  even:bg-primary-50  border-b align-top "
                        x-data="{ open: false }">
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $loop->iteration }}
                        </td>

                        <td scope="col"
                            class="px-6 py-3">
                            {{ $materi->name }}

                            <div x-show="open"
                                 x-cloak
                                 class="mt-2">
                                <ul>
                                    <li class="font-semibold">
                                        Indikator
                                    </li>
                                    <hr>
                                    @foreach ($materi->indikators as $indikator)
                                        <li class="flex justify-between w-full mt-2">
                                            <span>
                                                {{ $indikator->name }}
                                            </span>
                                            <div>
                                                <button class="text-xs bg-primary-900 p-1 px-2 rounded text-white cursor-pointer"
                                                        wire:click="$dispatch('openModal', { 
                                                                    component: 'modal.detail-indikator',
                                                                    arguments: { 
                                                                        indikator: {{ $indikator }}
                                                                    }
                                                                })">
                                                    Detail
                                                </button>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </td>

                        <td scope="col"
                            class="px-6 py-3">
                            <div class="flex gap-1 ">
                                <button class="text-xs bg-primary-900 p-1 px-2 rounded text-white cursor-pointer"
                                        @click="open = !open">

                                    Detail
                                </button>
                                <button class="text-xs bg-positive p-1 px-2 rounded text-white cursor-pointer"
                                        wire:click="$dispatch('openModal', { 
                                                    component: 'modal.tambah-indikator-materi',
                                                    arguments: { 
                                                        materi: {{ $materi }}
                                                    }
                                                })">

                                    Tambah Indikator
                                </button>
                            </div>
                        </td>

                    </tr>

                @empty

                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap"
                            colspan="4">
                            <div class="text-sm text-gray-900 text-center">
                                Data tidak ditemukan
                            </div>
                        </td>
                    </tr>
                @endforelse
                <tbody>

                </tbody>

            </table>

        </div>

        {{-- End Table --}}
    </div>

</div>

