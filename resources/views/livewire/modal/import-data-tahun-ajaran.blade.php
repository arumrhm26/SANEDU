<div class="p-5">

    <h1 class="text-2xl font-bold">Import Tahun Ajaran {{ $tahunAjaran->name }}</h1>

    <form x-data="{ showOptions: false }"
          wire:submit='save'>

        <div class="grid grid-cols-2 mt-8 items-center">

            <label for="tahun_ajaran"
                   class="font-semibold">
                Pilih data Tahun Ajaran
            </label>

            <div>

                <x-select wire:model="importOptions.tahunAjaranId"
                          @change="
                                        showOptions = $event.target.value !== '-';
                                        $wire.set('importOptions.tahunAjaranId', $event.target.value);
                                        $wire.set('importOptions.kelas', false);
                                        $wire.set('importOptions.siswa', false);
                                  "
                          id="tahun_ajaran"
                          class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                    <option value="-">Pilih Data Tahun Ajaran</option>
                    @forelse (App\Models\TahunAjaran::all() as $tahunAjaran)
                        <option value="{{ $tahunAjaran->id }}">{{ $tahunAjaran->name }}</option>
                    @empty
                        <option value="-">Data tidak ditemukan</option>
                    @endforelse
                </x-select>

            </div>

        </div>

        <div class="grid grid-cols-2 mt-4"
             x-show="showOptions">

            <label class="font-semibold">
                Pilih data yang akan di import
            </label>

            <div class="grid grid-cols-2">
                <div>
                    <input type="checkbox"
                           class="form-checkbox h-5 w-5 text-gray-600"
                           id="kelas"
                           name="kelas"
                           value="kelas"
                           wire:model.live="importOptions.kelas" />
                    <label for="kelas">Kelas</label>
                </div>

                <div>

                    <input type="checkbox"
                           class="form-checkbox h-5 w-5 text-gray-600"
                           id="siswa"
                           name="siswa"
                           value="siswa"
                           wire:model.live="importOptions.siswa"
                           @change="
                                        $event.target.checked ? $wire.set('importOptions.kelas', true) : $wire.set('importOptions.kelas', false);
                                      " />

                    <label for="siswa">Siswa</label>
                </div>

            </div>

        </div>

        {{-- Button --}}
        <div class="flex items-center justify-end gap-4 mt-2">
            <x-primary-button class="text-sm disabled:opacity-50"
                              wire:loading.attr='disabled'>

                {{ __('Simpan') }}
                <div wire:loading>
                    <x-icons.dot-loading class="text-white" />
                </div>
            </x-primary-button>
        </div>
        {{-- End Button --}}
    </form>

</div>

