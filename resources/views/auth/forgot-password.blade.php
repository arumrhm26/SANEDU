<x-guest-layout>
    <div class="min-h-screen flex justify-center items-center bg-zinc-50">
        <div class="max-w-sm bg-white p-6 rounded-lg shadow-md w-96">
            <div class="mb-4 text-sm text-gray-600">
                Silahkan masukan email Anda, kami akan mengirimkan link untuk mereset password Anda.
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4"
                                   :status="session('status')" />

            <form method="POST"
                  action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email"
                                   :value="__('Email')" />
                    <x-text-input id="email"
                                  class="block mt-1 w-full"
                                  type="email"
                                  name="email"
                                  :value="old('email')"
                                  required
                                  autofocus />
                    <x-input-error :messages="$errors->get('email')"
                                   class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('Lanjutkan') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

