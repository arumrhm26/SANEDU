<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sanedu') }}</title>

    <!-- Fonts -->
    <link rel="preconnect"
          href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
          rel="stylesheet" />

    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
          rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Scripts -->
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans text-gray-900 antialiased bg-gray-200">

    <div class="max-w-screen-2xl mx-auto relative shadow-2xl min-h-screen bg-white"
         x-data="{ sidebar: false }">
        <x-admin.admin-sidebar />
        <x-admin.admin-sidebar-mobile />
        <main class="sm:ml-64 min-h-full ">
            <x-admin.admin-navbar />
            <div class="p-4">
                <div class="mb-4">
                    {{ Breadcrumbs::render() }}
                </div>

                @isset($header)
                    <header class="font-bold text-2xl mb-4">
                        {{ $header }}
                    </header>
                @endisset

                {{ $slot }}
            </div>
        </main>
    </div>

    <x-toaster-hub />
    @livewire('wire-elements-modal')
    @livewireScripts
    @stack('scripts')
</body>

</html>

