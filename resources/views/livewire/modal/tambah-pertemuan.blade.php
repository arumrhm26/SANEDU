<div class="p-5">
    <div class="flex gap-2 items-center">
        <h2 class="text-lg font-semibold text-gray-600">Tambah Pertemuan</h2>
    </div>
    <div class="mt-4">
        <form wire:submit="create"
              class="flex flex-col gap-2">

            <div class="grid grid-cols-2 mt-0">
                <label for="kelas"
                       class="font-semibold">
                    Kelas
                </label>

                <select name="kelas"
                        id="kelas"
                        wire:model.live="classRoomId"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                    <option>Pilih Kelas</option>
                    @forelse (App\Models\ClassRoom::where('tahun_ajaran_id', $tahunAjaranId)->get() as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->full_name }}</option>
                    @empty
                        <option value="-">Data tidak ditemukan</option>
                    @endforelse
                </select>

            </div>

            <div class="grid grid-cols-2 mt-0">
                <label for="mata_pelajaran"
                       class="font-semibold">
                    Mata Pelajaran
                </label>

                <select name="mata_pelajaran"
                        id="mata_pelajaran"
                        wire:model.live="subjectId"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                    <option>Pilih Mata Pelajaran</option>
                    @forelse ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @empty
                        <option value="-">Data tidak ditemukan</option>
                    @endforelse
                </select>

            </div>

            <div class="grid grid-cols-2 mt-0">
                <label for="materi"
                       class="font-semibold">
                    Materi
                </label>

                <div>
                    <select name="materi"
                            id="materi"
                            wire:model.live="materiId"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                        <option>Pilih Materi</option>
                        @forelse ($materis as $materi)
                            <option value="{{ $materi->id }}">{{ $materi->name }}</option>
                        @empty
                            <option value="-">Data tidak ditemukan</option>
                        @endforelse
                    </select>

                    <x-input-error :messages="$errors->get('materiId')"
                                   class="my-2" />
                </div>

            </div>

            <div class="grid grid-cols-2 mt-0">
                <label for="tanggal"
                       class="font-semibold">
                    Tanggal
                </label>

                <div>
                    <input size="sm"
                           type="date"
                           wire:model="tanggal"
                           placeholder="Tanggal"
                           onfocus="this.showPicker()"
                           class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" />

                    <x-input-error :messages="$errors->get('tanggal')"
                                   class="my-2" />
                </div>

            </div>

            <div class="grid grid-cols-2 mt-0">
                <label for="jam"
                       class="font-semibold">
                    Waktu Mulai
                </label>

                <div>
                    <input type="time"
                           wire:model="waktu_mulai"
                           placeholder="Jam"
                           onfocus="this.showPicker()"
                           class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" />

                    <x-input-error :messages="$errors->get('waktu_mulai')"
                                   class="my-2" />
                </div>

            </div>

            <div class="grid grid-cols-2 mt-0">
                <label for="jam_selesai"
                       class="font-semibold">
                    Waktu Selesai
                </label>

                <div>
                    <input type="time"
                           wire:model="waktu_selesai"
                           placeholder="Jam"
                           onfocus="this.showPicker()"
                           class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" />

                    <x-input-error :messages="$errors->get('waktu_selesai')"
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

