<div>
    <div class="p-5">
        {{ Breadcrumbs::render('guru.progres-pembelajaran') }}
    </div>

    <div class="px-5">
        <h2 class="text-lg font-semibold text-gray-600">Progres Pembelajaran</h2>
    </div>

    <div class="p-5 flex flex-col gap-2 sm:flex-row sm:justify-end ">

        <livewire:select2 name="tahun-ajaran"
                          :options="App\Models\TahunAjaran::all()"
                          wire:model.live='tahunAjaran'
                          :key="App\Models\TahunAjaran::all()->pluck('id')->join('-') . 'tahun-ajaran'" />

        {{-- Select Mata Pelajaran --}}
        <livewire:select2-subject name="mata-pelajaran"
                                  :options="$subjects"
                                  wire:model.live='subject'
                                  :key="!empty($subjects) ? $subjects?->pluck('id')->join('-') . 'mapel' : null" />
        {{-- End Select Mata Pelajaran --}}

    </div>

    <div class="flex gap-1 p-5 justify-end">
        <button class="bg-positive px-5 py-2 text-white rounded shadow disabled:bg-gray-400"
                wire:click="exportPDF"
                wire:loading.attr='disabled'
                @if (empty($this->students)) disabled @endif>
            PDF
            <div wire:loading
                 wire:target='exportPDF'>
                <x-icons.dot-loading class="text-white" />
            </div>
        </button>
        <button class="bg-positive px-5 py-2 text-white rounded shadow disabled:bg-gray-400"
                wire:click="exportExcel"
                wire:loading.attr='disabled'
                @if (empty($this->students)) disabled @endif>
            Excel
            <div wire:loading
                 wire:target='exportExcel'>
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
                    <th scope="col"
                        class="px-6 py-3">
                        Kelas
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($this->students as $student)
                    <tr class="odd:bg-white  even:bg-primary-50 ">
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $loop->iteration }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $student->user->name }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ App\Models\ClassRoom::find($classRoomId)->full_name }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            <div class="flex gap-1">
                                <a class="text-xs bg-primary-900 p-1 px-2 rounded text-white"
                                   wire:navigate
                                   href="{{ route('guru.progres-pembelajaran.show', [$subject, $student]) }}">
                                    Detail
                                </a>
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
            {{ !empty($this->students) ? $this->students->links() : '' }}
        </div>
    </div>

</div>

