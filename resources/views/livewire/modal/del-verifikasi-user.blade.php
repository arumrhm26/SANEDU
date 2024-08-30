<div class="p-5">
    <header class="font-bold text-xl">
        Hapus User
    </header>

    <div class="mt-4">
        <h2 class="font-semibold text-lg">
            Detail User
        </h2>
        <div class="mt-1">
            <div class="flex">
                <div class="w-1/3">
                    <p class="font-semibold">Nama</p>
                </div>
                <div class="w-2/3">
                    <p>
                        @isset($user->name)
                            {{ $user->name }}
                        @endisset
                    </p>
                </div>
            </div>
            <div class="flex">
                <div class="w-1/3">
                    <p class="font-semibold">Email</p>
                </div>
                <div class="w-2/3">
                    <p>
                        @isset($user->email)
                            {{ $user->email }}
                        @endisset
                    </p>
                </div>
            </div>
            <div class="flex">
                <div class="w-1/3">
                    <p class="font-semibold">Status</p>
                </div>
                <div class="w-2/3">
                    <p>
                        @isset($user)
                            {{ $user->getRoleNames()->first() }}
                        @endisset
                    </p>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <span>
                Apa anda yakin ingin
                <span class="font-bold">
                    menghapus
                </span>
                user ini?
            </span>
        </div>
        <div class="flex justify-end gap-2">
            <button wire:click="reject"
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

