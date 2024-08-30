<x-modal name="tambah-siswa-kelas">
    <div class="p-2">
        {{-- loading --}}
        <div class="h-56 items-center justify-center"
             wire:loading.flex
             wire:target='classRoom'>
            <x-icons.dot-loading class="w-10 h-10 mx-auto" />
        </div>
        {{-- end loading --}}

        {{-- content --}}
        <div class="p-2"
             wire:loading.remove
             wire:target='classRoom'>

            {{-- Header --}}
            <div class="flex items-center gap-2">

                <div>
                    <h2 class="font-bold text-xl">
                        Tambah Siswa ke Kelas {{ $classRoom->full_name ?? '' }}
                    </h2>
                </div>

            </div>
            {{-- End Header --}}

            {{-- search --}}
            <div class="flex justify-start mt-4">
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
            {{-- end search --}}

            <div class="mt-4">

                {{-- table with checkboxes --}}
                <table class="w-full border border-gray-300 rounded-lg text-left "
                       x-data="{ selectAll: false }"
                       @close-modal.window="selectAll = false;
                       document.getElementById('selectAllToggle').checked = false;
                       $dispatch('select-all', false);
                        ">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="border-b border-gray-300 p-2 text-sm text-gray-900 w-10">
                                <input type="checkbox"
                                       class="form-checkbox h-5 w-5 text-gray-600"
                                       id="selectAllToggle"
                                       wire:model.live.boolean='selectAllToggle'
                                       @click="
                                            selectAll = !selectAll
                                            $dispatch('select-all', selectAll)
                                       " />

                            </th>
                            <th class="border-b border-gray-300 p-2 text-sm text-gray-900">Nama</th>
                            <th class="border-b border-gray-300 p-2 text-sm text-gray-900">Cabang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->students as $student)
                            <tr class=""
                                wire:key="{{ $student->id }}">

                                <td class="border-b border-gray-300 p-2 text-sm text-gray-900">
                                    <input type="checkbox"
                                           id="checkbox.{{ $student->id }}"
                                           class="form-checkbox h-5 w-5 text-gray-600"
                                           wire:model="selectedStudents"
                                           value="{{ $student->id }}"
                                           x-bind:checked="selectAll" />
                                </td>

                                <td class="border-b border-gray-300 p-2 text-sm text-gray-900">
                                    {{ $student->user->name }}
                                </td>
                                <td class="border-b border-gray-300 p-2 text-sm text-gray-900">
                                    {{ $student->cabang->nama }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- end table --}}

                {{-- error label --}}
                <x-input-error :messages="$errors->get('selectedStudents')"
                               class="mt-2" />
                {{-- end error label --}}

                {{-- button --}}
                <div class="flex items-center justify-end gap-4 mt-2">
                    <x-primary-button class="text-sm disabled:opacity-50"
                                      wire:click='save'
                                      wire:loading.attr='disabled'>

                        {{ __('Simpan') }}
                        <div wire:loading>
                            <x-icons.dot-loading class="text-white" />
                        </div>
                    </x-primary-button>
                </div>
                {{-- end button --}}

            </div>

        </div>
        {{-- end content --}}
    </div>

</x-modal>

