<section class="">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Siswa') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Perbarui informasi siswa anda') }}
        </p>
    </header>

    <form class="mt-6 space-y-6"
          wire:submit='updateProfilSiswa'>

        <div>
            <x-input-label for="asal_sekolah"
                           :value="__('Asal Sekolah')" />
            <x-text-input class="mt-1 block w-full"
                          id="asal_sekolah"
                          name="asal_sekolah"
                          type="text"
                          required
                          placeholder="Asal Sekolah"
                          wire:model="asal_sekolah" />
            <x-input-error class="mt-2"
                           :messages="$errors->get('asal_sekolah')" />
        </div>

        <div>
            <x-input-label for="cabang"
                           :value="__('Cabang')" />
            <x-select class="mt-1 block w-full"
                      id="cabang"
                      name="cabang"
                      required
                      wire:model="cabang_id">
                <option value="">Pilih Cabang</option>
                @foreach (App\Models\Cabang::all() as $cabang)
                    <option value="{{ $cabang->id }}">{{ $cabang->nama }}</option>
                @endforeach
            </x-select>

            <x-input-error class="mt-2"
                           :messages="$errors->get('cabang_id')" />

        </div>

        <div class="flex items-center justify-end gap-4">
            <x-primary-button class="text-sm disabled:opacity-50">
                {{ __('Simpan') }}
                <div wire:loading>
                    <x-icons.dot-loading class="text-white" />
                </div>
            </x-primary-button>
        </div>
    </form>
</section>

