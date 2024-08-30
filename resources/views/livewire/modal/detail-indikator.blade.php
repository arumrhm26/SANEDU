<div class="p-5">
    <h1 class="text-xl font-bold">
        Detail Indiaktor {{ $indikator->name }}
    </h1>

    <form class="mt-4"
          wire:submit='save'>

        {{-- table with checkboxes --}}
        <table class="w-full border border-gray-300 rounded-lg text-left ">
            <thead>
                <tr class="bg-gray-50">
                    <th class="border-b border-gray-300 p-2 text-sm text-gray-900">Nama</th>
                    <th class="border-b border-gray-300 p-2 text-sm text-gray-900">Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studentIndikators as $studentIndikator)
                    <tr class="">

                        <td class="border-b border-gray-300 p-2 text-sm text-gray-900">
                            {{ $loop->iteration }}.
                            {{ $studentIndikator->student->user->name }}
                        </td>
                        <td class="border-b border-gray-300 p-2 text-sm text-gray-900">
                            <input type="number"
                                   class="w-full border border-gray-300 rounded-lg p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                   wire:model="studentNilais.{{ $studentIndikator->id }}">
                            <x-input-error :messages="$errors->get('studentNilais.' . $studentIndikator->id)"
                                           class="mt-2" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- end table --}}

        {{-- error label --}}
        <x-input-error :messages="$errors->get('selectedStudents')"
                       class="mt-2" />
        {{-- end error label --}}

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

