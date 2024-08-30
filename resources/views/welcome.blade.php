<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>SANEDU</title>

    <!-- Fonts -->
    <link rel="preconnect"
          href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap"
          rel="stylesheet" />

    <!-- Scripts -->
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    <main class="min-h-screen bg-[url('../images/pattern-randomized.svg')]">

        <div class=" z-10 absolute p-5 w-full">
            <nav
                 class=" w-full flex justify-between items-center px-5 py-2 rounded-full backdrop-blur-md  shadow-md hover:shadow-lg">
                <div class="inline-flex items-center gap-2">
                    <img src="{{ asset('logo.png') }}"
                         alt="logo"
                         class="w-12 h-12" />
                    <span class="text-xl font-bold">SANEDU</span>
                </div>
            </nav>
        </div>

        <section class="h-screen flex items-center justify-center">
            <div class="text-center mx-auto max-w-screen-sm">
                <h1 class="text-9xl font-semibold">SanEdu</h1>
                <div class="max-w-sm mx-auto">
                    <h4 class="">
                        SANEDU adalah aplikasi pendampingan belajar online pertama yang mengusung konsep
                        multiple system dan konseling
                    </h4>

                </div>
                <div class="flex gap-2 justify-center items-center mt-4">

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                               class="bg-primary-800 text-white px-4 py-1 rounded-md shadow hover:bg-primary-700 transition-all">
                                DASHBOARD
                            </a>
                        @else
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="bg-primary-800 text-white px-4 py-1 rounded-md shadow hover:bg-primary-700 transition-all">
                                    DAFTAR
                                </a>
                            @endif
                            <a href="{{ route('login') }}"
                               class="underline text-primary-800">
                                MASUK
                            </a>

                        @endauth

                    @endif

                </div>
            </div>
        </section>

    </main>

</body>

</html>

