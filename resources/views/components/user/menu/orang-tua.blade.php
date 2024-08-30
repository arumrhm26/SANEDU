<div class="grid grid-cols-2 gap-y-10 sm:grid-cols-4 justify-items-center px-5 mt-12">

    <x-buttons.dashboard-menu-user wire:navigate
                                   href="{{ route('orangtua.kehadiran-siswa') }}">
        <x-slot:icon>
            <x-icons.desk class="w-10 h-10" />
        </x-slot>
        {{ __('Kehadiran Siswa') }}
    </x-buttons.dashboard-menu-user>

    <x-buttons.dashboard-menu-user wire:navigate
                                   href="{{ route('orangtua.progres-pembelajaran-siswa') }}">
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

