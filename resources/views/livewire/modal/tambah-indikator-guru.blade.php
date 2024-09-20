<div class="p-5">
    <h1 class="text-2xl font-semibold">Tambah Indikator</h1>
    <form wire:submit='save'
          class="mt-8 gap-2 flex flex-col">

        <div class="flex">
            <div class="w-1/3">
                <label for="name"
                       class="font-semibold">Tahun Ajaran</label>
            </div>
            <div class="w-2/3">
                <select wire:model.live="tahunAjaranId"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 px-5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                    <option value="-">Tahun Ajaran</option>
                    @forelse ($tahunAjarans as $tahunAjaran)
                        <option value="{{ $tahunAjaran->id }}">{{ $tahunAjaran->name }}</option>
                    @empty
                        <option value="-">Data tidak ditemukan</option>
                    @endforelse
                </select>
                <x-input-error :messages="$errors->get('tahunAjaranId')"
                               class="mt-2" />
            </div>
        </div>
        <div class="flex">
            <div class="w-1/3">
                <label for="name"
                       class="font-semibold">Mata Pelajaran</label>
            </div>
            <div class="w-2/3">
                <select wire:model.live="subjectId"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 px-5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                    <option value="-">Mata Pelajaran</option>
                    @forelse ($subjects as $subject)
                        <option value="{{ $subject->id }}">
                            {{ $subject->name }}
                            |
                            {{ $subject?->classRoom?->full_name }}
                        </option>
                    @empty
                        <option value="-">Data tidak ditemukan</option>
                    @endforelse
                </select>
                <x-input-error :messages="$errors->get('subjectId')"
                               class="mt-2" />
            </div>
        </div>
        <div class="flex">
            <div class="w-1/3">
                <label for="name"
                       class="font-semibold">Materi</label>
            </div>
            <div class="w-2/3">
                <select wire:model.live="materiId"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 px-5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                    <option value="-">Materi</option>
                    @forelse ($materis as $materi)
                        <option value="{{ $materi?->id }}">
                            {{ $materi?->name }}
                        </option>
                    @empty
                        <option value="-">Data tidak ditemukan</option>
                    @endforelse
                </select>
                <x-input-error :messages="$errors->get('materiId')"
                               class="mt-2" />
            </div>
        </div>
        <div class="flex">
            <div class="w-1/3">
                <label for="name"
                       class="font-semibold">Nama Indikator</label>
            </div>
            <div class="w-2/3">
                <x-text-input wire:model="indikatorName"
                              size="sm" />
                <x-input-error :messages="$errors->get('indikatorName')"
                               class="mt-2" />
            </div>
        </div>

        {{-- Button --}}
        <div class="flex items-center justify-end gap-4 mt-2">
            <x-primary-button class="text-sm disabled:opacity-50"
                              wire:loading.attr='disabled'>

                {{ __('Simpan') }}
                <div wire:loading>
                    <x-icons.dot-loading class="text-white" />
                </div>
            </x-primary-button>
        </div>
        {{-- End Button --}}

    </form>
</div>

