<div>

    <h1 class="text-xl font-semibold px-5">Progres Pembelajaran</h1>

    <div class="p-5 flex gap-2 flex-col sm:flex-row justify-start sm:items-center">

        <livewire:select2 name="tahun-ajaran"
                          :options="App\Models\TahunAjaran::all()"
                          wire:model.live='tahunAjaran'
                          :key="App\Models\TahunAjaran::all()->pluck('id')->join('-')" />

        <livewire:select2 name="mata-pelajaran"
                          :options="$subjects"
                          wire:model.live='subject'
                          key="
                            {{ !empty($subjects) ? $subjects->pluck('id')->join('-') : null }}" />

        <livewire:select2 name="materi"
                          :options="$materis"
                          wire:model.live='materi'
                          key="
                                {{ !empty($materis) ? $materis->pluck('id')->join('-') : null }}" />

    </div>

    <div class="px-5 flex justify-end">
        <button class="bg-positive px-5 py-2 text-white rounded shadow"
                wire:click='exportPDF'>
            Export
        </button>
    </div>

    <div class="px-5 overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-white divide-y divide-gray-200">
                <tr class="odd:bg-white  even:bg-gray-100  border-b text-left">
                    <th scope="col"
                        class="px-6 py-3">
                        Kode
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Indikator Ukur
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Nilai
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Pengajar
                    </th>

                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 ">
                @forelse ($studentIndikators as $studentIndikator)
                    <tr class="odd:bg-white  even:bg-gray-100 ">
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $studentIndikator->indikator?->code ?? '-' }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $studentIndikator->indikator->name ?? '-' }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $studentIndikator->nilai ?? '-' }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $studentIndikator->indikator->materi->subject?->teacher->user->name ?? '-' }}
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4"
                            class="text-center p-5">Data tidak ditemukan</td>
                    </tr>
                @endforelse

            </tbody>
        </table>

    </div>

</div>

