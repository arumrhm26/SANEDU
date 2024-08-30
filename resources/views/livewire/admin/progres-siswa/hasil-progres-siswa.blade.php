<x-slot:header>
    <h2>
        {{ __('Progres Siswa') }}
    </h2>
</x-slot>

<div>
    <div class="bg-primary-100 rounded-lg">
        <div class="flex justify-between items-center pr-5">
            <div class="flex items-center gap-3 p-4 font-semibold">
                <x-antdesign-user-o class="h-10 w-10" />
                <h3>Hasil Progress Siswa</h3>
            </div>

        </div>

        <div class="flex flex-col gap-4 p-4 md:flex-row md:justify-between">
            <div class="flex items-center gap-2">
                <h4 class="font-semibold">Show</h4>
                <select wire:model.live="perPage"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 ">
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
                              name="search"
                              wire:model.live.debounce.500ms="search"
                              placeholder="Search..."
                              size="sm" />
            </div>

        </div>

        <div class="flex items-center gap-2">
            <form class="flex flex-col  md:flex-row md:items-center gap-2 p-4 max-w-full">

                <livewire:select2 name="tahun-ajaran"
                                  :options="App\Models\TahunAjaran::all()"
                                  wire:model.live='tahunAjaran'
                                  :key="App\Models\TahunAjaran::all()->pluck('id')->join('-') . 'tahun-ajaran'" />

                @if ($tahunAjaran)
                    <livewire:select2 name="grade"
                                      :options="App\Models\Grade::all()"
                                      wire:model.live='grade'
                                      :key="App\Models\Grade::all()->pluck('id')->join('-') . 'grade'" />
                @endif

                @if ($grade)
                    <livewire:select2 name="kelas"
                                      :options="$classRooms"
                                      wire:model.live='classRoom'
                                      :key="$classRooms->pluck('id')->join('-') . 'kelas'" />
                @endif

            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left ">
                <thead class="text-sm bg-primary-200">
                    <tr>
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
                            Mata Pelajaran
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Materi
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Indikator
                        </th>
                        <th scope="col"
                            class="px-6 py-3">
                            Nilai
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($studentIndikators as $studentIndikator)
                        <tr class="odd:bg-white  even:bg-primary-50  border-b ">
                            <td class="px-6 py-3">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-3">
                                {{ $studentIndikator->student->user->name }}
                            </td>
                            <td class="px-6 py-3">
                                {{ $studentIndikator->indikator->materi->subject->classRoom->full_name }}
                            </td>
                            <td class="px-6 py-3">
                                {{ $studentIndikator->indikator->materi->subject->name }}
                            </td>
                            <td class="px-6 py-3">
                                {{ $studentIndikator->indikator->materi->name }}
                            </td>
                            <td class="px-6 py-3">
                                {{ $studentIndikator->indikator->name }}
                            </td>
                            <td class="px-6 py-3">
                                {{ $studentIndikator->nilai }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-3"
                                colspan="7">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- pagination --}}
            <div class="p-4">
                {{ $studentIndikators->links() }}
            </div>
        </div>
    </div>
</div>

