<div class="p-5">

    <h1 class="text-2xl font-bold">Edit Tahun Ajaran {{ $tahunAjaran->name }}</h1>

    <form wire:submit='save'
          class="flex flex-col gap-2 mt-4">

        <div class="grid grid-cols-2 mt-0">

            <label for="tahun_ajaran"
                   class="font-semibold">
                Tahun Ajaran
            </label>

            <div>
                <x-text-input size="sm"
                              type="text"
                              wire:model="name"
                              placeholder="Tahun Ajaran"
                              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" />

                <x-input-error :messages="$errors->get('name')"
                               class="my-2" />
            </div>

        </div>

        <div class="grid grid-cols-2">

            <label for="tahun_ajaran"
                   class="font-semibold">
                Tanggal Mulai Tahun Ajaran
            </label>

            <div>
                <x-text-input size="sm"
                              wire:model="mulai"
                              type="date"
                              placeholder="Tanggal Mulai Tahun Ajaran"
                              onfocus="this.showPicker()"
                              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" />

                <x-input-error :messages="$errors->get('mulai')"
                               class="my-2" />
            </div>

        </div>
        <div class="grid grid-cols-2">

            <label for="tahun_ajaran"
                   class="font-semibold">
                Tanggal Berakhir Tahun Ajaran
            </label>

            <div>
                <x-text-input size="sm"
                              wire:model="selesai"
                              type="date"
                              placeholder="Tanggal Berakhir Tahun Ajaran"
                              onfocus="this.showPicker()"
                              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" />

                <x-input-error :messages="$errors->get('selesai')"
                               class="my-2" />
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

