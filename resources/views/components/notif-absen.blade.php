<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative w-full">

    <strong class="font-bold">{{ $message ?? 'Berhasil' }}</strong>
    <p class="mt-5">Status :
        <x-chip-absen status="{{ $status }}" />
    </p>
</div>

