<div class="p-5">
    <header class="font-bold text-lg">
        <h2>
            {{ __('Edit Guru') }}
        </h2>
    </header>
    <form wire:submit="save">
        <div class="mt-4">
            <div class="mt-1 flex flex-col gap-2">
                <div class="flex">
                    <div class="w-1/3">
                        <label for="name"
                               class="font-semibold">Nama</label>
                    </div>
                    <div class="w-2/3">
                        <x-text-input wire:model="forms.name"
                                      size="sm" />
                        <x-input-error :messages="$errors->get('forms.name')"
                                       class="mt-2" />
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/3">
                        <label for="email"
                               class="font-semibold">Email</label>
                    </div>
                    <div class="w-2/3">
                        <x-text-input wire:model="forms.email"
                                      type="email"
                                      size="sm" />
                        <x-input-error :messages="$errors->get('forms.email')"
                                       class="mt-2" />
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/3">
                        <label for="student_email"
                               class="font-semibold">Email Siswa</label>
                    </div>
                    <div class="w-2/3">
                        <x-text-input wire:model="forms.student_email"
                                      size="sm" />
                        <x-input-error :messages="$errors->get('forms.student_email')"
                                       class="mt-2" />
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/3">
                        <label for="hubungan"
                               class="font-semibold">Hubungan</label>
                    </div>
                    <div class="w-2/3">
                        <x-text-input wire:model="forms.hubungan"
                                      size="sm" />
                        <x-input-error :messages="$errors->get('forms.hubungan')"
                                       class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <span>
                    Apa anda yakin ingin
                    <span class="font-bold">
                        mengedit
                    </span>
                    user ini?
                </span>
            </div>
            <div class="flex justify-end gap-2">
                <button type="submit"
                        class="text-white px-4 py-1 rounded-md bg-positive flex items-center gap-2">
                    Ya
                    <div wire:loading>
                        <x-icons.dot-loading class="text-white" />
                    </div>
                </button>
                <button wire:click.prevent="$dispatch('closeModal')"
                        class="text-white px-4 py-1 rounded-md bg-gray-600">
                    Batal
                </button>
            </div>
        </div>
    </form>
</div>

