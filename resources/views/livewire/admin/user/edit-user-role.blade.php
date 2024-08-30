<section class="mt-4">
    <h1 class="text-xl font-bold">Role</h1>
    <hr class="h-px bg-red-600 mt-1 mb-4 border-0">
    <form wire:submit='updateUserRole'>

        <div class="flex flex-col md:flex-row gap-4 ">
            <div class="flex gap-1 flex-col w-full">
                <x-input-label value="Status Akun"
                               class="font-semibold" />

                <div class="flex gap-2 items-center">
                    <div class="w-full max-w-sm">
                        <x-select wire:model='role'>
                            <option value="-">Pilih Status</option>
                            @foreach (Spatie\Permission\Models\Role::all() as $role)
                                <option value="{{ $role->id }}">{{ Str::title($role->name) }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <button class="text-sm disabled:opacity-50 bg-red-600 p-2 px-4 rounded-md text-white font-semibold">
                        {{ __('Simpan') }}
                        <div wire:loading>
                            <x-icons.dot-loading class="text-white" />
                        </div>
                    </button>
                </div>
            </div>
        </div>

    </form>

</section>

