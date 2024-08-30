<section class="mt-8">
    <h1 class="text-xl font-bold">Detail {{ Str::title($user->getRoleNames()->first()) }}</h1>
    <hr class="h-px bg-gray-200 mt-1 mb-4 border-0">
    <form wire:submit='save'>
        <div class="flex flex-col md:flex-row gap-4 ">
            <div class="flex gap-1 flex-col w-full">
                <x-input-label value="Rekening Bank"
                               class="font-semibold" />

                <div>
                    <x-text-input wire:model="rekening_bank" />
                    <x-input-error class="mt-2"
                                   :messages="$errors->get('rekening_bank')" />
                </div>
            </div>
            <div class="flex gap-1 flex-col w-full">
                <x-input-label value="No Rekening"
                               class="font-semibold" />
                <div>
                    <x-text-input wire:model="no_rekening" />
                    <x-input-error class="mt-2"
                                   :messages="$errors->get('no_rekening')" />
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end gap-4 mt-2">
            <x-primary-button class="text-sm disabled:opacity-50">
                {{ __('Simpan') }}
                <div wire:loading>
                    <x-icons.dot-loading class="text-white" />
                </div>
            </x-primary-button>
        </div>
    </form>
</section>

