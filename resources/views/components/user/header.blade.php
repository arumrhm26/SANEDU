<div class="px-5 mx-auto h-[250px] bg-cover text-center text-white flex flex-col justify-center items-center"
     style="background-image: url({{ Vite::asset('resources/images/bg-dashboard.png') }})">
    <h1 class="font-bold text-2xl">
        Hai
        @auth
            {{ auth()->user()->name }}
        @else
            User
        @endauth

    </h1>
    <h2 class="text-xl">Selamat datang di Sistem Akademik Sanedu</h2>
</div>

