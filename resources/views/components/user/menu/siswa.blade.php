<div class="grid grid-cols-2 gap-y-10 sm:grid-cols-4 justify-items-center px-5 mt-12">

    <div x-data="{ open: false }"
         class="relative cursor-pointer">

        <a class="text-center flex flex-col items-center max-w-40 relative"
           @click="open = !open">
            <x-icons.desk class="w-10 h-10" />
            <span class="font-semibold break-words">Presensi</span>
            <x-dropdowns.dropdown-container class="-left-10 top-16 bg-white">
                <x-dropdowns.dropdown-button href="{{ route('siswa.scan-qr') }}">
                    Scan QR Code
                </x-dropdowns.dropdown-button>
                <x-dropdowns.dropdown-button wire:navigate
                                             href="{{ route('siswa.riwayat-kehadiran') }}">
                    Riwayat Kehadiran
                </x-dropdowns.dropdown-button>
            </x-dropdowns.dropdown-container>
        </a>

    </div>

    <x-buttons.dashboard-menu-user wire:navigate
                                   href="{{ route('siswa.progres-pembelajaran') }}">
        <x-slot:icon>
            <x-icons.book class="w-10 h-10" />
        </x-slot>
        {{ __('Progress Pembelajaran') }}
    </x-buttons.dashboard-menu-user>

    <x-buttons.dashboard-menu-user wire:navigate
                                   href="{{ route('settings') }}">
        <x-slot:icon>
            <x-antdesign-setting class="w-10 h-10 text-primary-950" />
        </x-slot>
        {{ __('Pengaturan Profil') }}
    </x-buttons.dashboard-menu-user>

    {{-- logout --}}

    <form method="POST"
          action="{{ route('logout') }}">
        @csrf

        {{-- <x-responsive-nav-link :href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-responsive-nav-link> --}}
        <x-buttons.dashboard-menu-user
                                       onclick="event.preventDefault();
                                                this.closest('form').submit();">
            <x-slot:icon>
                <x-gmdi-logout-o class="w-10 h-10 text-red-500" />
            </x-slot>
            {{ __('Logout') }}
        </x-buttons.dashboard-menu-user>
    </form>
    {{-- endlogut --}}
</div>

