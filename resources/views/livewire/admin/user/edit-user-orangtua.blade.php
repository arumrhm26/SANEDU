<section class="mt-8">
    <h1 class="text-xl font-bold">Detail {{ Str::title($user->getRoleNames()->first()) }}</h1>
    <hr class="h-px bg-gray-200 mt-1 mb-4 border-0">
    <form wire:submit='save'>
        <div class="flex flex-col md:flex-row gap-4 ">
            <div class="flex gap-1 flex-col w-full">
                <x-input-label value="Hubungan dengan siswa"
                               class="font-semibold" />

                <div>

                    <x-text-input wire:model="hubungan"
                                  type="text" />

                    <x-input-error class="mt-2"
                                   :messages="$errors->get('hubungan')" />
                </div>

            </div>
            <div class="flex gap-1 flex-col w-full">
                <x-input-label value="Siswa"
                               class="font-semibold" />
                <div>

                    <x-select wire:model='student_id'>

                        @foreach ($childs as $child)
                            <option value="{{ $child->user->id }}">{{ $child->user->name }}</option>
                        @endforeach
                    </x-select>

                    <x-input-error class="mt-2"
                                   :messages="$errors->get('student_id')" />

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

