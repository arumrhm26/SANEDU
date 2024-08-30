<section class="mt-8">
    <h1 class="text-xl font-bold">Detail {{ Str::title($user->getRoleNames()->first()) }}</h1>
    <hr class="h-px bg-gray-200 mt-1 mb-4 border-0">

    <form wire:submit='save'>
        <div class="flex flex-col md:flex-row gap-4 ">
            <div class="flex gap-1 flex-col w-full">
                <x-input-label value="Asal Sekolah"
                               class="font-semibold" />

                <div>

                    <x-text-input wire:model="asal_sekolah" />
                    <x-input-error class="mt-2"
                                   :messages="$errors->get('asal_sekolah')" />
                </div>

            </div>
            <div class="flex gap-1 flex-col w-full">
                <x-input-label value="Cabang"
                               class="font-semibold" />
                <div>
                    <x-select wire:model='cabang_id'>
                        <option value="-">Pilih Cabang</option>
                        @foreach (App\Models\Cabang::all() as $cabang)
                            <option value="{{ $cabang->id }}">{{ $cabang->nama }}</option>
                        @endforeach
                    </x-select>

                    <x-input-error class="mt-2"
                                   :messages="$errors->get('cabang_id')" />

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

