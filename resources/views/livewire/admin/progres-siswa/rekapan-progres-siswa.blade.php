<x-slot:header>
    <h2>
        {{ __('Progres Siswa') }}
    </h2>
</x-slot>

<div>
    <div class="bg-primary-100 rounded-lg">
        <div class="flex justify-between items-center pr-5">
            <div class="flex items-center gap-3 p-4 font-semibold">
                <h3>Rekapan Progress Siswa</h3>
            </div>

            <div class="flex gap-1 items-start">
                <button @class([
                    ' px-5 py-2 text-white rounded shadow',
                    'bg-gray-400' => !$this->materiId,
                    'bg-positive' => $this->materiId,
                ])
                        wire:click='exportPDF'>
                    PDF
                </button>
            </div>

        </div>

        <div class="flex flex-col gap-4 p-4 md:flex-row md:justify-between">
            <div class="flex items-center gap-2">
                <h4 class="font-semibold">Show</h4>
                <select wire:model.live="perPage"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="300">300</option>
                    <option value="400">400</option>
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

        <div class="flex items-center">
            <div class="flex flex-col  sm:flex-row sm:items-center gap-2 p-4 w-full sm:w-max">

                <livewire:select2 name="tahun-ajaran"
                                  :options="App\Models\TahunAjaran::all()"
                                  wire:model.live='tahunAjaranId'
                                  :key="App\Models\TahunAjaran::all()->pluck('id')->join('-') . 'tahun-ajaran'" />

                @if ($tahunAjaranId)
                    <livewire:select2 name="grade"
                                      :options="App\Models\Grade::all()"
                                      wire:model.live='gradeId'
                                      :key="App\Models\Grade::all()->pluck('id')->join('-') . 'grade'" />
                @endif

                @if ($gradeId)
                    <livewire:select2 name="kelas"
                                      :options="$classRooms"
                                      wire:model.live='classRoomId'
                                      :key="$classRooms->pluck('id')->join('-') . 'kelas'" />
                @endif

                @if ($classRoomId)
                    <livewire:select2 name="mata-pelajaran"
                                      :options="$subjects"
                                      wire:model.live='subjectId'
                                      :key="$subjects->pluck('id')->join('-') . 'mata-pelajaran'" />
                @endif

                @if ($subjectId)
                    <livewire:select2 name="materi"
                                      :options="$materis"
                                      wire:model.live='materiId'
                                      :key="$materis->pluck('id')->join('-') . 'materi'" />
                @endif
            </div>

        </div>

        <div class="overflow-x-auto">
            @if ($this->materiId)
                <table class="w-full text-sm text-left">
                    <thead class="text-sm bg-primary-200">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3">
                                Nama Siswa
                            </th>
                            @forelse ($this->indikators() as $indikator)
                                <th class="px-6 py-3">{{ $indikator->name }}</th>
                            @empty
                            @endforelse
                            <th scope="col"
                                class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->students() as $student)
                            <tr class="odd:bg-white  even:bg-primary-50  border-b ">
                                <td scope="col"
                                    class="px-6 py-3">
                                    {{ $student->user->name ?? '-' }}
                                </td>
                                @forelse ($this->indikators() as $indikator)
                                    <td class="px-6 py-3">
                                        {{ $this->getStudentIndikator($student->id, $indikator->id)->nilai ?? '-' }}
                                    </td>
                                @empty
                                @endforelse
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
                                                class="text-xs bg-primary-900 p-1 px-2 rounded text-white cursor-pointer">
                                            Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>

                        @empty

                            <div class="w-full bg-white">
                                <p class="text-center">Data tidak ditemukan</p>
                            </div>
                        @endforelse
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- Modal --}}
    <livewire:modal.edit-progres-siswa />
    {{-- End Modal --}}
</div>
