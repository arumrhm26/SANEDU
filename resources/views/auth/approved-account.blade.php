<x-guest-layout>
    <div class="flex justify-center items-center h-screen bg-zinc-100">
        <div class="bg-white p-10 rounded-xl shadow-lg">
            <h1 class="font-bold text-center text-2xl mb-5">Akun Anda Belum Disetujui</h1>
            <p class="text-center">Silahkan hubungi admin untuk dapat mengakses semua fitur</p>
            <div class="flex justify-center mt-5">

                <form method="POST"
                      action="{{ route('logout') }}">
                    @csrf

                    <button class="bg-red-700 p-2 px-8 rounded-md text-white hover:bg-red-600">
                        Logout
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-guest-layout>

