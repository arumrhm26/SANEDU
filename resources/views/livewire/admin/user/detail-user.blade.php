<div class="max-w-screen-md">

    <h2 x-data="{ text: @js($user->name) }"
        @user-updated.window="text = $event.detail.name;"
        x-text="text"
        class="text-2xl font-semibold text-gray-800 mb-4">
        {{ $user->name }}
    </h2>

    {{-- Detail akun --}}
    <livewire:admin.user.edit-akun :$user />
    {{-- End Detail akun --}}

    {{-- Detail user --}}
    @if ($user->hasRole('guru'))
        <livewire:admin.user.edit-user-guru :$user />
    @elseif ($user->hasRole('siswa'))
        <livewire:admin.user.edit-user-siswa :$user />
    @endif
    {{-- End Detail user --}}

    <div class="bg-red-50 ring-red-600 ring-1 p-4 mt-8 rounded">

        {{-- Detail Ganti Password --}}
        <livewire:admin.user.edit-user-password :$user />
        {{-- End Ganti Password --}}

    </div>

</div>
