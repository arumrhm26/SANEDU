<div>
    <h2 class="font-semibold text-2xl">{{ $student->user->name }} | {{ $classRoom->full_name }} |
        {{ $tahunAjaran->name }}</h2>

    {{-- datfar halaman --}}
    <div class="mt-4">
        <ul class="list-disc ml-5">
            <li>
                <a href="#absen-siswa"
                   class="text-primary-700 underline">
                    Absen Siswa
                </a>
            </li>
            <li>
                <a href="#progres-siswa"
                   class="text-primary-700 underline">
                    Progres Siswa
                </a>
            </li>
        </ul>
    </div>

    <livewire:admin.user.kelas.detail-siswa.absen-siswa-table :$student
                                                              :$classRoom>

        <livewire:admin.user.kelas.detail-siswa.progres-siswa-table :$student
                                                                    :$classRoom>
</div>

