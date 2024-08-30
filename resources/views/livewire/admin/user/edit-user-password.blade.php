<section class="">
    <h1 class="text-xl font-bold">Ganti Password</h1>
    <hr class="h-px bg-red-600 mt-1 mb-4 border-0">
    <form wire:submit='save'>
        <div class="flex flex-col md:flex-row gap-4 ">
            <div class="flex gap-1 flex-col w-full">
                <x-input-label value="Password Baru"
                               class="font-semibold" />
                <div>
                    <x-text-input type="password"
                                  wire:model="password" />
                    <x-input-error class="mt-2"
                                   :messages="$errors->get('password')" />

                </div>
            </div>
            <div class="flex gap-1 flex-col w-full">
                <x-input-label value="Ulangi Password Baru"
                               class="font-semibold" />
                <div>
                    <x-text-input type="password"
                                  wire:model="password_confirmation" />
                    <x-input-error class="mt-2"
                                   :messages="$errors->get('password_confirmation')" />

                </div>
            </div>
        </div>
        <div class="flex items-center justify-end gap-4 mt-2">
            <x-primary-button class="text-sm disabled:opacity-50 bg-red-600 hover:bg-red-700">
                {{ __('Simpan') }}
                <div wire:loading>
                    <x-icons.dot-loading class="text-white" />
                </div>
            </x-primary-button>
        </div>
    </form>
</section>

