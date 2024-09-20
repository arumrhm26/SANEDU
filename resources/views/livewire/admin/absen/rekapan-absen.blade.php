<x-slot:header>
    <h2>
        {{ __('Absensi') }}
    </h2>
</x-slot>

<div>
    {{-- Start Tabs --}}
    <ul class="flex flex-wrap font-sm text-sm text-center border-b border-gray-200 mt-4">
        <li class="me-2">
            <a class="inline-block p-3 py-2 rounded-t-lg text-white cursor-pointer bg-gray-400"
               href="{{ route('admin.absen') }}">
                Pertemuan
            </a>
        </li>
        <li class="me-2">
            <a class="inline-block p-3 py-2 rounded-t-lg text-white cursor-pointer bg-primary-950"
               href="{{ route('admin.absen.rekapan') }}">
                Rekapan
            </a>
        </li>
    </ul>
    {{-- End Tabs --}}

    {{-- Start Table --}}
    <div class="bg-primary-100 rounded-lg rounded-tl-none">

        <div>
            <div class="bg-primary-100 rounded-lg">

                <div class="flex justify-between items-center">
                    <div class="flex items-center p-5 gap-x-2">
                        <div>
                            <select wire:model.live="tahunAjaranId"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 px-5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                                <option value="-">Tahun Ajaran</option>
                                @forelse ($tahunAjarans as $tahunAjaran)
                                    <option value="{{ $tahunAjaran->id }}">{{ $tahunAjaran->name }}</option>
                                @empty
                                    <option value="-">Data tidak ditemukan</option>
                                @endforelse
                            </select>
                        </div>

                        <div>
                            <select wire:model.live="bulan"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 px-5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                                <option value="-">Bulan</option>
                                @forelse ($bulans as $bulan)
                                    <option value="{{ $bulan->id }}">{{ $bulan->name }}</option>
                                @empty
                                    <option value="-">Data tidak ditemukan</option>
                                @endforelse
                            </select>

                        </div>

                    </div>
                    <div class="pr-5">
                        <button @class([
                            'px-5 py-2 text-white rounded shadow',
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
                                wire:click='exportPDF'>
                            Export
                        </button>
                    </div>
                </div>

                <div class="px-5">
                    <h3 class="font-bold text-xl">Pertemuan</h3>
                </div>

                <div class="flex flex-col gap-4 p-5 md:flex-row md:justify-between">

                    <div class="flex items-center gap-2">
                        <h4 class="font-semibold">Show</h4>
                        <select id="small"
                                wire:model.live = 'perPage'
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                        </select>
                        <p class="">entries</p>
                    </div>

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

                <div class="overflow-x-auto">
                    <table class="text-sm min-w-max w-full text-left table-auto">
                        <thead class="text-sm bg-primary-200">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 min-w-36">
                                    Tanggal
                                </th>
                                <th scope="col"
                                    class="px-6 py-3">
                                    Kelas
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 min-w-36">
                                    Jam
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 ">
                                    Mata Pelajaran
                                </th>
                                <th scope="col"
                                    class="px-6 py-3">
                                    Materi
                                </th>
                                <th scope="col"
                                    class="px-6 py-3">
                                    Tutor
                                </th>
                                <th scope="col"
                                    class="px-6 py-3">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($pertemuans as $pertemuan)
                                <tr class="odd:bg-white  even:bg-primary-50  border-b ">
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
                                        {{ $pertemuan->waktu_mulai }} - {{ $pertemuan->waktu_selesai }}
                                    </td>
                                    <td scope="col"
                                        class="px-6 py-3 text-ellipsis">
                                        {{ $pertemuan->materi->subject->name }}
                                    </td>
                                    <td scope="col"
                                        class="px-6 py-3">
                                        {{ $pertemuan->materi->name }}
                                    </td>
                                    <td scope="col"
                                        class="px-6 py-3">
                                        {{ $pertemuan->materi->subject?->teacher->user->name ?? '-' }}
                                    </td>
                                    <td scope="col"
                                        class="px-6 py-3">
                                        <div class="flex gap-1">

                                            <a class="text-xs bg-primary-900 p-1 px-2 rounded text-white"
                                               wire:navigate
                                               href="{{ route('admin.absen.show', $pertemuan) }}">
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

                                <tr class="bg-white">
                                    <td class="px-6 py-4"
                                        colspan="7">
                                        Data tidak ditemukan
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                    <div class="p-4">
                        {{ $pertemuans->links() }}
                    </div>
                </div>
            </div>

        </div>

    </div>
    {{-- End Table --}}

</div>

