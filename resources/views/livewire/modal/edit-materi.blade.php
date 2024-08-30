<div class="p-5">

    <h1 class="text-2xl font-semibold">Edit Materi</h1>

    <form wire:submit='save'
          class="mt-8">

        <div class="flex">
            <div class="w-1/3">
                <label for="name"
                       class="font-semibold">Nama Materi</label>
            </div>
            <div class="w-2/3">
                <x-text-input wire:model="name"
                              size="sm" />
                <x-input-error :messages="$errors->get('name')"
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

