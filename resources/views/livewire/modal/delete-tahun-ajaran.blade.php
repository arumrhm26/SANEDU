<div class="p-5">
    <header class="font-bold text-xl">
        Hapus Tahun Ajaran {{ $tahunAjaran->name }}
    </header>

    <div class="mt-4">

        <div class="mt-2">
            <span>
                Apakah anda yakin ingin
                <span class="font-bold">
                    menghapus
                </span>
                tahun ajaran ini?
            </span>
        </div>
        <div class="flex justify-end gap-2">
            <button wire:click="delete"
                    class="text-white px-4 py-1 rounded-md bg-red-600">
                Ya
            </button>
            <button wire:click="$dispatch('closeModal')"
                    class="text-white px-4 py-2 rounded-md bg-positive">
                Batal
            </button>
        </div>
    </div>

</div>

