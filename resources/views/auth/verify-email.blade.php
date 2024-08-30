<x-guest-layout>
    <div class="max-w-screen-md h-screen flex flex-col justify-center mx-auto px-4">
        <div class="mb-4 text-sm text-gray-600 text-justify">
            Terima Kasih sudah melakukan registasi. Sebelum melanjutkan, silahkan cek kotak masuk pada email
            <span class="font-bold">
                {{ auth()->user()->email }}
            </span> untuk melakukan verifikasi email. Jika belum menerima email, silahkan klik
            tombol dibawah ini untuk mengirim ulang email verifikasi.
        </div>

        <p class="text-sm text-gray-600 mb-4 font-bold">
            Catatan: Anda dapat menghubungi admin untuk dapat melakukan verifikasi akun.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Verifikasi email baru sudah dikirim kedalam kotak masuk email anda.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST"
                  action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-primary-button class="text-sm">
                        {{ __('Kirim ulang email verifikasi') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="flex gap-2 items-center">

                <a href="{{ route('settings') }}"
                   class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Edit Profile') }}
                </a>
                <span>atau</span>
                <form method="POST"
                      action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                            class="underline text-sm text-red-500 hover:text-red-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-guest-layout>

