<div class="px-3 py-4 text-white overflow-y-auto flex-1">

    <ul class="space-y-2 font-medium">
        <x-admin.sidebar-button href="{{ route('admin.index') }}">
            <x-slot:icon>
                <x-antdesign-appstore class="w-5 h-5" />
            </x-slot>
            Dashboard
        </x-admin.sidebar-button>

        <x-admin.sidebar-dropdown-container title="User"
                                            slug="user">
            <x-slot:icon>
                <x-antdesign-user-o class="w=5 h-5" />
            </x-slot>
            <x-admin.sidebar-dropdown-button href="{{ route('admin.verifikasi-akun') }}">
                Verifikasi Akun
            </x-admin.sidebar-dropdown-button>
            <x-admin.sidebar-dropdown-button href="{{ route('admin.guru') }}">
                Tentor
            </x-admin.sidebar-dropdown-button>
            <x-admin.sidebar-dropdown-button href="{{ route('admin.siswa') }}">
                Siswa
            </x-admin.sidebar-dropdown-button>
            <x-admin.sidebar-dropdown-button href="{{ route('admin.orangtua') }}">
                Orang Tua
            </x-admin.sidebar-dropdown-button>
            <x-admin.sidebar-dropdown-button href="{{ route('admin.tahunajarankelas') }}"
                                             slug="user/tahun-ajaran-kelas">
                Tahun Ajaran & Kelas
            </x-admin.sidebar-dropdown-button>
        </x-admin.sidebar-dropdown-container>

        <x-admin.sidebar-button href="{{ route('admin.absen') }}"
                                slug="absen">
            <x-slot:icon>
                <x-antdesign-file-text-o class="w-5 h-5" />
            </x-slot>
            Absensi
        </x-admin.sidebar-button>

        <x-admin.sidebar-dropdown-container title="Progres Siswa">
            <x-slot:icon>
                <x-antdesign-user-o class="w=5 h-5" />
            </x-slot>
            <x-admin.sidebar-dropdown-button href="{{ route('admin.kelola-progres-siswa') }}"
                                             slug="progres-siswa/kelola">
                Kelola Progres Siswa
            </x-admin.sidebar-dropdown-button>
            <x-admin.sidebar-dropdown-button href="{{ route('admin.rekapan-progres-siswa') }}">
                Rekapan Progres Siswa
            </x-admin.sidebar-dropdown-button>
            {{-- <x-admin.sidebar-dropdown-button href="{{ route('admin.hasil-progres-siswa') }}">
                Hasil Progres Siswa
            </x-admin.sidebar-dropdown-button> --}}
        </x-admin.sidebar-dropdown-container>
    </ul>
</div>

