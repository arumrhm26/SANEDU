<div>

    <div class="p-5 flex flex-col justify-start sm:flex-row sm:justify-end">
        <livewire:select2 name="tahun-ajaran"
                          :options="App\Models\TahunAjaran::all()"
                          wire:model.live='tahunAjaran'
                          :key="App\Models\TahunAjaran::all()->pluck('id')->join('-')" />
    </div>

    <div class="px-5 flex justify-end">
        <button class="bg-positive px-5 py-2 text-white rounded shadow"
                wire:click='exportPDF'>
            Export
        </button>
    </div>

    <div class="px-5 overflow-auto">

        <table class="divide-y divide-gray-200 table-auto min-w-max w-full">
            <thead class="bg-white divide-y divide-gray-200">
                <tr class="odd:bg-white  even:bg-primary-50  border-b text-left">
                    <th scope="col"
                        class="px-6 py-3">
                        Tanggal
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Waktu Masuk
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Waktu Kehadiran
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Keterangan
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 ">

                @forelse ($pertemuanStudents as $pertemuanStudent)
                    <tr class="odd:bg-white  even:bg-gray-100 ">
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $pertemuanStudent->pertemuan->tanggal->isoFormat('dddd, D MMMM Y') }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $pertemuanStudent->pertemuan->waktu_mulai }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $pertemuanStudent->jam_masuk ?? '-' }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            <x-chip-absen status="{{ $pertemuanStudent->pertemuanStatus->name }}" />
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white">
                        <td class="px-6 py-4"
                            colspan="7">
                            Tidak ada data
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>

    </div>
    {{-- Pagination --}}
    <div class="p-5">
        {{ $pertemuanStudents->links() }}
    </div>

</div>
