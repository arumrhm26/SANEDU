<x-user-layout>

    <div class="p-5">
        {{ Breadcrumbs::render() }}
    </div>

    <div class="px-5">
        <h2 class="text-lg font-semibold text-gray-600">Riwayat Kehadiran Siswa</h2>
    </div>

    <livewire:siswa.riwayat-kehadiran-table />
</x-user-layout>

