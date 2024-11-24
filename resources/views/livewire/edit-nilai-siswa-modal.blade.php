<div class="p-4 space-y-2">
    <h1 class="text-xl font-bold">
        Edit Nilai Siswa
    </h1>
    @foreach ($this->indikators as $indikator)
        <div class="flex items-center gap-2">
            <div class="w-1/4">
                <label for="{{ $indikator->id }}"
                       class="block text-sm font-medium text-gray-700">
                    {{ $indikator->name }}
                </label>
            </div>
            <div class="w-3/4">
                <input type="number"
                       @keydown.enter.prevent="
                            $event.target.blur();
                            $refs.closeButton.click();
                        "
                       name="{{ $indikator->id }}"
                       id="{{ $indikator->id }}"
                       wire:model="nilais.{{ $indikator->id }}"
                       class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
    @endforeach

    <div class="flex justify-end">
        <button class="bg-positive px-5 py-2 text-white rounded shadow"
                wire:click="save"
                x-ref="closeButton">
            Simpan
        </button>
    </div>
</div>
