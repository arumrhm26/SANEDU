<div>

    <div class="p-5">
        {{ Breadcrumbs::render('guru.presensi') }}
    </div>

    <div class="px-5">
        <h2 class="text-lg font-semibold text-gray-600">Presensi</h2>
    </div>

    <div class="p-5 flex flex-col gap-4 sm:flex-row sm:justify-between ">

        <div>
            <x-primary-button class="text-sm"
                              wire:click="$dispatch('open-modal', {
                                            component: 'guru-tambah-pertemuan',
                                        })">
                Tambah Pertemuan
            </x-primary-button>
            <x-primary-button @class([
                'text-sm',
                'bg-gray-400' =>
                    !$bulan ||
                    !$tahunAjaranId ||
                    !$pertemuans->count() ||
                    $pertemuans->count() < 1 ||
                    $bulan === '-' ||
                    $tahunAjaranId === '-',
                'bg-positive' =>
                    $bulan &&
                    $tahunAjaranId &&
                    $pertemuans->count() &&
                    $pertemuans->count() > 0 &&
                    $bulan !== '-' &&
                    $tahunAjaranId !== '-',
            ])
                              wire:click="exportPDF">
                Export
            </x-primary-button>
        </div>

        <div class="flex gap-x-2 items-center">
            <livewire:select2 name="tahun-ajaran"
                              :options="$tahunAjarans"
                              wire:model.live='tahunAjaranId'
                              :key="$tahunAjarans->pluck('id')->join('-') . 'tahun-ajaran'" />

            <livewire:select2 name="bulan"
                              :options="$bulans"
                              wire:model.live='bulan'
                              :key="$tahunAjaranId . '-bulan'" />

        </div>

    </div>

    <div class="overflow-x-auto">

        <table class="divide-y divide-gray-200 table-auto min-w-max w-full">
            <thead class="bg-white divide-y divide-gray-200">
                <tr class="odd:bg-white  even:bg-primary-50  border-b text-left">
                    <th scope="col"
                        class="px-6 py-3">
                        Tanggal
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Kelas
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Mata Pelajaran
                    </th>
                    <th scope="col"
                        class="px-6 py-3">Materi</th>
                    <th scope="col"
                        class="px-6 py-3">
                        Jam
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($pertemuans as $pertemuan)
                    <tr class="odd:bg-white  even:bg-primary-50 ">
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $pertemuan->tanggal->format('d M Y') }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $pertemuan->materi->subject->classRoom->full_name }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $pertemuan->materi->subject->name }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $pertemuan->materi->name }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $pertemuan->waktu_mulai }} - {{ $pertemuan->waktu_selesai }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            <div class="flex gap-1">

                                <a class="text-xs bg-primary-900 p-1 px-2 rounded text-white"
                                   href="{{ route('guru.presensi-detail', $pertemuan) }}">
                                    Detail
                                </a>

                                <a class="text-xs bg-positive p-1 px-2 rounded text-white"
                                   href="{{ route('qr-code', $pertemuan) }}">
                                    QR Code
                                </a>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="odd:bg-white  even:bg-primary-50 ">
                        <td scope="col"
                            class="px-6 py-3"
                            colspan="5">
                            <div class="text-center text-gray-600">
                                Data tidak ditemukan
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-5">
            {{ $pertemuans->links() }}
        </div>

    </div>

    {{-- Modal --}}

    <x-modal name="guru-tambah-pertemuan">
        <form class="p-5"
              wire:submit='create'>
            <h1 class="text-2xl font-bold">Tambah Pertemuan</h1>

            <livewire:select2 name="kelas"
                              :options="$classRooms"
                              wire:model.live='classRoomId'
                              :key="!empty($classRooms) ? $classRooms->pluck('id')->join('-') . 'kelas' : null" />

            @if ($classRoomId)
                <livewire:select2 name="mata-pelajaran"
                                  :options="$subjects"
                                  wire:model.live='subject'
                                  :key="!empty($subjects) ? $subjects->pluck('id')->join('-') . 'mapel' : null" />
            @endif

            @if ($subject)
                <livewire:select2 name="materi"
                                  :options="$materis"
                                  wire:model.live='materi'
                                  :key="!empty($materis) ? $materis->pluck('id')->join('-') . 'materi' : null" />
                <x-input-error :messages="$errors->get('materi')"
                               class="mt-2" />
            @endif

            @if ($materi)
                <div class="flex space-x-2 mt-5">
                    <div>
                        <label for="tanggal">Tanggal</label>
                        <input type="date"
                               name="tanggal"
                               class="block w-full rounded border border-gray-300 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                               onfocus="this.showPicker()"
                               wire:model="tanggal" />
                        <x-input-error :messages="$errors->get('tanggal')"
                                       class="mt-2" />
                    </div>
                    <div>
                        <label for="waktu_mulai">Waktu Mulai</label>
                        <input type="time"
                               name="waktu_mulai"
                               class="block w-full rounded border border-gray-300 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                               onfocus="this.showPicker()"
                               wire:model="waktu_mulai" />
                        <x-input-error :messages="$errors->get('waktu_mulai')"
                                       class="mt-2" />
                    </div>
                    <div>
                        <label for="waktu_selesai">Waktu Selesai</label>
                        <input type="time"
                               name="waktu_selesai"
                               class="block w-full rounded border border-gray-300 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                               onfocus="this.showPicker()"
                               wire:model="waktu_selesai" />
                        <x-input-error :messages="$errors->get('waktu_selesai')"
                                       class="mt-2" />
                    </div>

                </div>
            @endif
            {{-- button --}}
            <div class="flex items-center justify-end gap-4 mt-2">
                <x-primary-button class="text-sm disabled:opacity-50"
                                  wire:loading.attr='disabled'>

                    {{ __('Simpan') }}
                    <div wire:loading>
                        <x-icons.dot-loading class="text-white" />
                    </div>
                </x-primary-button>
            </div>
            {{-- end button --}}
        </form>

    </x-modal>

    {{-- End Modal --}}
</div>
