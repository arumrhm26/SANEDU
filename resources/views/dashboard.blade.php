@php
    $role = Auth::user()->roles->first()->name;
@endphp
<x-guest-layout>
    <main class="min-h-screen mx-auto max-w-screen-md flex items-center px-4 bgred">
        <section class="w-full p-2 text-center">
            <h1>Anda berhasil Login, tunggu beberapa saat untuk dapat diarahkan ke halaman utama</h1>

            <div class="mt-4">
                <x-icons.dot-loading class="w-10 h-10 mx-auto " />
            </div>

        </section>
    </main>

    @once
        @push('scripts')
            <script>
                setTimeout(() => {
                    history.replaceState(null, '', "{{ route($role . '.index') }}");
                    window.location.replace("{{ route($role . '.index') }}")
                }, 1000);
            </script>
        @endpush
    @endonce

</x-guest-layout>

