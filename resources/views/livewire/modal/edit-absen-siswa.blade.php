<x-modal name="edit-absen-siswa">

    <div class="p-5">

        <h1 class="text-xl font-bold">
            Edit Pertemuan
        </h1>

        <form wire:submit='save'>

            <x-select name="absen-status"
                      id="absen-status"
                      wire:model='status'
                      wire:loading.attr='disabled'>

                <option value="-">Pilih Status</option>

                @forelse (App\Models\PertemuanStatus::all() as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @empty
                    <option value="-">Data tidak ditemukan</option>
                @endforelse
            </x-select>

            <x-input-error :messages="$errors->get('status')"
                           class="mt-2" />

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
