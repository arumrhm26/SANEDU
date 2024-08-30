<div class="grid grid-cols-2 md:grid-cols-4 gap-5 text-white">
    <x-admin.card>
        <x-slot name="content">
            {{ $tahunAjaran?->name ?? now()->year }}
        </x-slot>
        <x-slot name="icon">
            <img src="{{ Vite::asset('resources/images/uis_calender.png') }}">
        </x-slot>
        <x-slot name="title">
            Tahun Ajaran
        </x-slot>
    </x-admin.card>
    <x-admin.card>
        <x-slot name="content">
            {{ $tahunAjaran?->class_rooms_count ?? 0 }}
        </x-slot>
        <x-slot name="icon">
            <img src="{{ Vite::asset('resources/images/teacher.png') }}">
        </x-slot>
        <x-slot name="title">
            Jumlah Kelas
        </x-slot>
    </x-admin.card>
    <x-admin.card>
        <x-slot name="content">
            {{ $tahunAjaran?->class_room_students_count ?? 0 }}
        </x-slot>
        <x-slot name="icon">
            <img src="{{ Vite::asset('resources/images/campus.png') }}">
        </x-slot>
        <x-slot name="title">
            Jumlah Siswa
        </x-slot>
    </x-admin.card>
    <x-admin.card>
        <x-slot name="content">
            {{ $tahunAjaran?->teacherCount() ?? 0 }}
        </x-slot>
        <x-slot name="icon">
            <img src="{{ Vite::asset('resources/images/user.png') }}">
        </x-slot>
        <x-slot name="title">
            Jumlah Guru
        </x-slot>
    </x-admin.card>
</div>

