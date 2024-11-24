<div>
    <div class="p-5">
        {{ Breadcrumbs::render('guru.progres-pembelajaran') }}
    </div>

    <div class="px-5">
        <h2 class="text-lg font-semibold text-gray-600">Progres Pembelajaran</h2>
    </div>

    <div class="p-5 flex flex-col gap-2 sm:flex-row sm:justify-end sm:items-center">

        <div class="flex gap-2">

            <livewire:select2 name="tahun-ajaran"
                              :options="App\Models\TahunAjaran::all()"
                              wire:model.live='tahunAjaran'
                              :key="App\Models\TahunAjaran::all()->pluck('id')->join('-') . 'tahun-ajaran'" />

            {{-- Select Mata Pelajaran --}}
            <livewire:select2-subject name="mata-pelajaran"
                                      :options="$subjects"
                                      wire:model.live='subject'
                                      :key="!empty($subjects)
                                          ? $subjects?->pluck('id')->join('-') . 'mapel'
                                          : null" />
            {{-- End Select Mata Pelajaran --}}

            <livewire:select2 name="materi"
                              :options="$materis"
                              wire:model.live='materiId'
                              :key="!empty($materis) ? $materis?->pluck('id')->join('-') . 'materi' : null" />
        </div>

    </div>

    <div class="flex gap-1 p-5 justify-end">
        <button class="bg-positive px-5 py-2 text-white rounded shadow disabled:bg-gray-400"
                wire:click="exportPDF"
                wire:loading.attr='disabled'
                @if (empty($this->students())) disabled @endif>
            PDF
            <div wire:loading
                 wire:target='exportPDF'>
                <x-icons.dot-loading class="text-white" />
            </div>
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="divide-y divide-gray-200 table-auto min-w-max w-full">
            <thead class="bg-white divide-y divide-gray-200">
                <tr class="odd:bg-white  even:bg-primary-50  border-b text-left">
                    <th scope="col"
                        class="px-6 py-3 w-10">
                        No
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Nama
                    </th>
                    @foreach ($this->indikators as $indikator)
                        <th class="px-6 py-3">{{ $indikator->name }}</th>
                    @endforeach
                    <th scope="col"
                        class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($this->students() as $student)
                    <tr class="odd:bg-white  even:bg-primary-50 ">
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $loop->iteration }}
                        </td>

                        <td scope="col"
                            class="px-6 py-3">
                            {{ $student->user->name }}
                        </td>

                        @foreach ($this->indikators as $indikator)
                            <td class="px-6 py-3">
                                {{ $this->getNilai($student->id, $indikator->id) ?? '-' }}
                            </td>
                        @endforeach

                        <td scope="col"
                            class="px-6 py-3">
                            <div class="flex gap-1">
                                <button x-on:click="$dispatch('openModal', {
                                            component: 'edit-nilai-siswa-modal',
                                            arguments: {
                                                student: {{ $student->id }},
                                                materi: {{ $this->materiId }}
                                            }
                                        })"
                                        @class([
                                            'text-xs p-1 px-2 rounded text-white cursor-pointer',
                                            'bg-gray-400' => !$this->materiId,
                                            'bg-primary-900' => $this->materiId,
                                        ])>
                                    Edit
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <div class="w-full">
                        <div class="text-center p-5">
                            <p class="text-gray-400">Data tidak ditemukan</p>
                        </div>
                    </div>
                @endforelse
            </tbody>
        </table>

        <div class="p-5">
            {{ !empty($this->students) ? $this->students->links() : '' }}
        </div>
    </div>

</div>
