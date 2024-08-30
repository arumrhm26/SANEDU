<x-modal name="edit-progres-siswa">

    <div class="p-5">

        <h1 class="text-xl font-semibold">Edit Progres Siswa</h1>

        <form class="mt-4 flex flex-col gap-2"
              wire:submit='save'>

            <div class="flex items-center">
                <div class="w-1/3">
                    <label class="font-semibold">Nama</label>
                </div>
                <div class="w-2/3">
                    <x-text-input disabled
                                  value="{{ $studentIndikator->student->user->name ?? '' }}"
                                  size="sm" />
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/3">
                    <label class="font-semibold">Kelas</label>
                </div>
                <div class="w-2/3">
                    <x-text-input disabled
                                  value="{{ $studentIndikator->indikator->materi->subject->classRoom->full_name ?? '' }}"
                                  size="sm" />
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/3">
                    <label class="font-semibold">Mata Pelajaran</label>
                </div>
                <div class="w-2/3">
                    <x-text-input disabled
                                  value="{{ $studentIndikator->indikator->materi->subject->name ?? '' }}"
                                  size="sm" />
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/3">
                    <label class="font-semibold">Materi</label>
                </div>
                <div class="w-2/3">
                    <x-text-input disabled
                                  value="{{ $studentIndikator->indikator->materi->name ?? '' }}"
                                  size="sm" />
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/3">
                    <label class="font-semibold">Indikator</label>
                </div>
                <div class="w-2/3">
                    <x-text-input disabled
                                  value="{{ $studentIndikator->indikator->name ?? '' }}"
                                  size="sm" />
                </div>
            </div>

            <div class="flex items-center">
                <div class="w-1/3">
                    <label class="font-semibold">Nilai</label>
                </div>
                <div class="w-2/3">
                    <x-text-input wire:model="nilai"
                                  size="sm" />
                    <x-input-error :messages="$errors->get('nilai')"
                                   class="mt-2" />
                </div>
            </div>

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

    </div>

</x-modal>

