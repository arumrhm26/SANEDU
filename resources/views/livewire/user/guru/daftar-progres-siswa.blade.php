<div>

    <div class="p-5">
        {{ Breadcrumbs::render('guru.progres-pembelajaran.show', $subject, $student) }}
    </div>

    <div class="px-5">
        <h2 class="text-lg font-semibold text-gray-600">Daftar Progres Pembelajaran</h2>
    </div>

    <div class="px-5 mt-8">
        <h2 class="font-semibold text-gray-600">{{ $student->user->name }}</h2>
    </div>

    <div class="overflow-x-auto">

        <table class="divide-y divide-gray-200 table-auto min-w-max w-full">
            <thead class="bg-white divide-y divide-gray-200">
                <tr class="odd:bg-white  even:bg-primary-50  border-b text-left">
                    <th scope="col"
                        class="px-6 py-3 w-10">
                        Kode
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Indikator Ukur
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Materi
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Nilai
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($studentIndikators as $studentIndikator)
                    <tr class="odd:bg-white  even:bg-primary-50 ">
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $studentIndikator->indikator?->code ?? '-' }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $studentIndikator->indikator?->name ?? '-' }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $studentIndikator->indikator?->materi?->name ?? '-' }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $studentIndikator->nilai }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            <div class="flex gap-1">
                                <button class="text-xs bg-primary-900 p-1 px-2 rounded text-white"
                                        wire:click="$dispatch('open-modal', { component: 'edit-progres-siswa', studentIndikator: {{ $studentIndikator }}})">
                                    Edit
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="odd:bg-white  even:bg-primary-50 ">
                        <td scope="col"
                            class="px-6 py-3"
                            colspan="4">
                            <div class="text-center text-gray-600">
                                Data tidak ditemukan
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-5">
            {{ $studentIndikators->links() }}
        </div>
    </div>

    <livewire:modal.edit-progres-siswa />

</div>

