<main class="min-h-screen flex justify-center items-center">
    {!! QrCode::size(300)->generate($pertemuan->code) !!}
</main>

