<div>

    <div class="p-5">
        {{ Breadcrumbs::render('guru.presensi-detail', $pertemuan) }}
    </div>

    <div class="mt-2 px-5">
        <h1 class="text-2xl font-bold">Detail Pertemuan {{ $pertemuan->materi->name }}</h1>

        <table>
            <tr>
                <td class="w-40">Kelas</td>
                <td class="w-10">:</td>
                <td>{{ $pertemuan->materi->subject->classRoom->full_name }}</td>
            </tr>

            <tr>
                <td>Mata Pelajaran</td>
                <td>:</td>
                <td>{{ $pertemuan->materi->subject->name }}</td>
            </tr>
            <tr>
                <td class="">Materi</td>
                <td>:</td>
                <td>{{ $pertemuan->materi->name }}</td>
            </tr>

            <tr>
                <td class="">Waktu</td>
                <td>:</td>
                <td>{{ $pertemuan->waktu_mulai }} - {{ $pertemuan->waktu_selesai }}</td>
            </tr>
            <tr>
                <td class="">Tutor</td>
                <td>:</td>
                <td>{{ $pertemuan->materi->subject?->teacher->user->name ?? '-' }}</td>
            </tr>
        </table>

    </div>

    <div class="flex gap-1 p-5 justify-end">
        <button class="bg-positive px-5 py-2 text-white rounded shadow"
                wire:click="exportPDF">
            PDF
        </button>
    </div>

    <div class="overflow-x-auto mt-4">

        <table class="divide-y divide-gray-200 table-auto min-w-max w-full">
            <thead class="bg-white divide-y divide-gray-200">
                <tr class="odd:bg-white even:bg-primary-50  border-b text-left">
                    <th scope="col"
                        class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Waktu Hadir
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Status
                    </th>
                    @forelse (App\Models\PertemuanStatus::all() as $status)
                        <th class="px-6 py-3">{{ $status->name }}</th>
                    @empty
                        <th class="px-6 py-3">Data tidak ditemukan</th>
                    @endforelse
                    <th scope="col"
                        class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($pertemuanStudents as $pertemuanStudent)
                    <tr class="odd:bg-white even:bg-primary-50  border-b ">
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $pertemuanStudent->student->user->name ?? '-' }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $pertemuanStudent->jam_masuk ?? '-' }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            <x-chip-absen status="{{ $pertemuanStudent->pertemuanStatus->name }}" />
                        </td>

                        @forelse (App\Models\PertemuanStatus::all() as $status)
                            <td class="px-6 py-3">
                                <input type="radio"
                                       name="{{ $pertemuanStudent->id }}"
                                       id="{{ $pertemuanStudent->id . $status->id }}"
                                       value="{{ $status->id }}"
                                       wire:model.live="status.{{ $pertemuanStudent->id }}"
                                       wire:loading.attr="disabled"
                                       {{ $status->id == $pertemuanStudent->pertemuanStatus->id ? 'checked' : '' }}>
                            </td>
                        @empty
                            <td>Data tidak ditemukan</td>
                        @endforelse
                        <td scope="col"
                            class="px-6 py-3">
                            <div class="flex gap-2">
                                <button class="text-xs bg-primary-900 p-1 px-2 rounded text-white"
                                        x-on:click="$refs.openModalButton.click()">
                                    Edit
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"
                            class="text-center py-3">Data tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-5">
            {{ $pertemuanStudents->links() }}
        </div>

        <button class="hidden"
                x-ref="openModalButton"
                x-on:click="$dispatch('openModal', {component: 'edit-pertemuan-modal', arguments: {
                                                pertemuan: {{ $pertemuan }}
                                            } })">

        </button>

    </div>

</div>
