<div class="p-5">
    <div class="flex gap-2 items-center">
        <h2 class="text-lg font-semibold text-gray-600">Tambah Kelas</h2>
    </div>
    <div class="mt-4">
        <form wire:submit="save"
              class="flex flex-col gap-2">

            <div class="grid grid-cols-2 mt-0">
                <label for="cabang"
                       class="font-semibold">
                    Cabang
                </label>

                <div>

                    <select name="cabang"
                            id="cabang"
                            wire:model="form.cabang_id"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                        <option>Pilih Cabang</option>
                        @foreach (App\Models\Cabang::all() as $cabang)
                            <option value="{{ $cabang->id }}">{{ $cabang->nama }}</option>
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('form.cabang_id')"
                                   class="my-2" />
                </div>

            </div>

            <div class="grid grid-cols-2 mt-0">
                <label for="grade"
                       class="font-semibold">
                    Grade Kelas
                </label>

                <div>
                    <select name="grade"
                            id="grade"
                            wire:model="form.grade_id"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                        <option>Pilih Grade</option>
                        @foreach (App\Models\Grade::all() as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('form.grade_id')"
                                   class="my-2" />
                </div>

            </div>

            <div class="grid grid-cols-2 mt-0">
                <label for="name"
                       class="font-semibold">
                    Nama Kelas
                </label>

                <div>
                    <x-text-input size="sm"
                                  type="text"
                                  wire:model="form.name"
                                  placeholder="Nama Kelas"
                                  class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" />

                    <x-input-error :messages="$errors->get('form.name')"
                                   class="my-2" />
                </div>

            </div>

            <div class="grid grid-cols-2">
                <label for="limit_siswa"
                       class="font-semibold">
                    Limit Siswa
                </label>

                <div>
                    <x-text-input size="sm"
                                  wire:model="form.limit_siswa"
                                  type="number"
                                  inputmode="numeric"
                                  placeholder="Jumlah Makasimum Siswa"
                                  class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" />

                    <x-input-error :messages="$errors->get('form.limit_siswa')"
                                   class="my-2" />
                </div>

            </div>
            <div class="flex justify-end">

                <button type="submit"
                        class="text-white px-4 py-1 rounded-md bg-positive flex items-center gap-2 mt-2">
                    Tambah
                    <div wire:loading>
                        <x-icons.dot-loading class="text-white" />
                    </div>
                </button>

            </div>
        </form>
    </div>
</div>

