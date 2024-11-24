<div class="p-4">
    <h1 class="text-xl mb-8">
        Edit Absensi
    </h1>

    <table class="w-full text-sm text-left border-collapse border border-gray-300 overflow-hidden">
        <thead>
            <tr class="text-center bg-primary-700 text-white">
                <th class="px-2 py-2 border border-zinc-300 ">No</th>
                <th class="px-2 py-2 border border-zinc-300 ">Nama</th>
                <th class="px-2 py-2 border border-zinc-300 ">Status</th>
                @forelse (App\Models\PertemuanStatus::all() as $status)
                    <th class="px-2 py-2 border border-zinc-300 ">{{ $status->name }}</th>
                @empty
                    <th class="px-2 py-2 border border-zinc-300 ">Data tidak ditemukan</th>
                @endforelse
            </tr>
        </thead>

        <tbody>
            @forelse ($this->pertemuan->pertemuanStudents as $pertemuanStudent)
                <tr>
                    <td class="px-2 py-2 border border-zinc-300 ">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-2 py-2 border border-zinc-300 ">
                        {{ $pertemuanStudent->student->user->name ?? '' }}
                    </td>
                    <td class="px-2 py-2 border border-zinc-300 ">
                        {{ $pertemuanStudent->pertemuanStatus->name ?? '' }}
                    </td>

                    <!--radio box-->
                    @forelse (App\Models\PertemuanStatus::all() as $status)
                        <td class="px-2 py-2 border border-zinc-300 text-center">
                            <input type="radio"
                                   name="{{ $pertemuanStudent->id }}"
                                   id="{{ $pertemuanStudent->id . $status->id }}"
                                   value="{{ $status->id }}"
                                   wire:model.live="statuses.{{ $pertemuanStudent->id }}"
                                   wire:loading.attr="disabled"
                                   {{ $status->id == $pertemuanStudent->pertemuanStatus->id ? 'checked' : '' }}>
                        </td>
                    @empty
                        <td>Data tidak ditemukan</td>
                    @endforelse

                </tr>
            @empty
                <tr>
                    <td colspan="3">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="flex justify-end mt-4">
        <button wire:click="save"
                class="bg-blue-700 text-white px-4 py-2 rounded"
                wire:loading.attr="disabled">
            Simpan
        </button>
    </div>
</div>
