<div class="p-5">
    <header class="font-bold text-lg">
        <h2>
            {{ __('Buat Mata Pelajaran') }}
        </h2>
    </header>
    <form wire:submit="save">
        <div class="mt-4">
            <div class="mt-1 flex flex-col gap-2">
                <div class="flex">
                    <div class="w-1/3">
                        <label for="name"
                               class="font-semibold">Nama Mata Pelajaran</label>
                    </div>
                    <div class="w-2/3">
                        <x-text-input wire:model="form.name"
                                      size="sm" />
                        <x-input-error :messages="$errors->get('form.name')"
                                       class="mt-2" />
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/3">
                        <label for="form.teacher_id"
                               class="font-semibold">Guru</label>
                    </div>
                    <div class="w-2/3">

                        <select wire:model="form.teacher_id"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Pilih Guru</option>
                            @foreach (App\Models\User::with('teacher')->role('guru')->get() as $user)
                                <option value="{{ $user->teacher->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('form.teacher_id')"
                                       class="mt-2" />
                    </div>
                </div>

                <div class="flex">
                    <div class="w-1/3">
                        <label for="form.classRoom_id"
                               class="font-semibold">Kelas</label>
                    </div>
                    <div class="w-2/3">

                        @if ($classRoom)
                            <x-text-input size="sm"
                                          value="{{ $classRoom->full_name }}"
                                          readonly />
                        @else
                            <select wire:model="form.class_room_id"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Pilih Kelas</option>
                                @foreach (App\Models\ClassRoom::all() as $classRoom)
                                    <option value="{{ $classRoom->id }}">{{ $classRoom->full_name }}</option>
                                @endforeach
                            </select>
                        @endif

                        <x-input-error :messages="$errors->get('form.class_room_id')"
                                       class="mt-2" />
                    </div>
                </div>

            </div>
            <div class="mt-4">
                <span>
                    Apa anda yakin ingin
                    <span class="font-bold">
                        membuat
                    </span>
                    mata pelajaran ini?
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

