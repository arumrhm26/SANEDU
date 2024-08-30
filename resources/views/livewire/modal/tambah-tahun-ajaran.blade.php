<div class="p-5"
     wire:key='tambah-tahun-ajaran'>
    <div class="flex gap-2 items-center">
        <h2 class="text-lg font-semibold text-gray-600">Tambah Tahun Ajaran</h2>
    </div>
    <div class="mt-4">
        <form wire:submit="save"
              class="flex flex-col gap-2">

            <div class="grid grid-cols-2 mt-0">

                <label for="tahun_ajaran"
                       class="font-semibold">
                    Tahun Ajaran
                </label>

                <div>
                    <x-text-input size="sm"
                                  type="text"
                                  wire:model="form.name"
                                  placeholder="Tahun Ajaran"
                                  class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" />

                    <x-input-error :messages="$errors->get('form.name')"
                                   class="my-2" />
                </div>

            </div>
            <div class="grid grid-cols-2">

                <label for="tahun_ajaran"
                       class="font-semibold">
                    Tanggal Mulai Tahun Ajaran
                </label>

                <div>
                    <x-text-input size="sm"
                                  wire:model="form.mulai"
                                  type="date"
                                  placeholder="Tanggal Mulai Tahun Ajaran"
                                  onfocus="this.showPicker()"
                                  class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" />

                    <x-input-error :messages="$errors->get('form.mulai')"
                                   class="my-2" />
                </div>

            </div>
            <div class="grid grid-cols-2">

                <label for="tahun_ajaran"
                       class="font-semibold">
                    Tanggal Berakhir Tahun Ajaran
                </label>

                <div>
                    <x-text-input size="sm"
                                  wire:model="form.selesai"
                                  type="date"
                                  placeholder="Tanggal Berakhir Tahun Ajaran"
                                  onfocus="this.showPicker()"
                                  class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" />

                    <x-input-error :messages="$errors->get('form.selesai')"
                                   class="my-2" />
                </div>

            </div>

            {{-- Import Data --}}
            <div x-data="{ show: false, showOptions: false }">
                <div class="grid grid-cols-2 mt-4">

                    <div></div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox"
                               class="form-checkbox h-5 w-5 text-gray-600"
                               id="importData"
                               name="importData"
                               wire:model.live.boolean="form.importData"
                               @click="show = !show" />

                        <label for="importData">Import Data</label>
                    </div>

                </div>

                <div class="grid grid-cols-2 mt-8 items-center"
                     x-show="show">

                    <label for="tahun_ajaran"
                           class="font-semibold">
                        Pilih data Tahun Ajaran
                    </label>

                    <div>

                        <x-select wire:model="form.importOptions.tahunAjaranId"
                                  @change="
                                        showOptions = $event.target.value !== '-';
                                        $wire.set('form.importOptions.tahunAjaranId', $event.target.value);
                                        $wire.set('form.importOptions.kelas', false);
                                        $wire.set('form.importOptions.siswa', false);
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
                     x-show="showOptions && show">

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
                                   wire:model.live="form.importOptions.kelas"
                                   @change="
                                   {{-- set if siswa already checked, then uncheck siswa but if not then let it un checked --}}
                                        $event.target.checked ? $wire.set('form.importOptions.siswa', false) : $wire.set('form.importOptions.siswa', false);
                                      " />
                            <label for="kelas">Kelas</label>
                        </div>

                        <div>

                            <input type="checkbox"
                                   class="form-checkbox h-5 w-5 text-gray-600"
                                   id="siswa"
                                   name="siswa"
                                   value="siswa"
                                   wire:model.live="form.importOptions.siswa"
                                   @change="
                                        $event.target.checked ? $wire.set('form.importOptions.kelas', true) : $wire.set('form.importOptions.kelas', false);
                                      " />

                            <label for="siswa">Siswa</label>
                        </div>

                    </div>

                </div>

            </div>
            {{-- Import Data --}}

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
</div>

