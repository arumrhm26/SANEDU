<x-guest-layout>
    <!-- Session Status -->
    {{-- <x-auth-session-status class="mb-4" :status="session('status')" />


    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> --}}

    <div class="flex min-h-screen">
        <div
             class="flex-1 bg-primary-600 max-h-screen overflow-hidden md:flex flex-col justify-center items-center gap-11 rounded-r-full hidden">
            {{-- <x-image-login1 /> --}}

            <h1 class="font-semibold text-white text-4xl">Glad to see you!</h1>
            <img src="{{ Vite::asset('resources/images/imageLogin2.png') }}"
                 alt="image-login2"
                 class="max-w-96 mx-auto">
        </div>
        <div class="flex flex-[1.2] flex-col justify-center items-center gap-10">
            <img src="{{ Vite::asset('resources/images/9565efbc2e74840355eecf3fe1b7a204.png') }}"
                 alt="logo"
                 class="w-24">
            <form method="POST"
                  action="{{ route('login') }}"
                  class="bg-[#D9D9D9] p-10 py-5 rounded-xl">
                @csrf

                <h1 class="font-bold text-center text-2xl mb-5">LOGIN</h1>

                <div class="mb-4 w-72">
                    <x-text-input id="email"
                                  class="block mt-1 w-full"
                                  type="email"
                                  name="email"
                                  :value="old('email')"
                                  required
                                  autofocus
                                  placeholder="Email" />
                    <x-input-error :messages="$errors->get('email')"
                                   class="mt-2" />
                </div>

                <div class="mb-2">
                    <x-text-input type="password"
                                  name="password"
                                  id="password"
                                  required
                                  placeholder="Password" />
                    <x-input-error :messages="$errors->get('password')"
                                   class="mt-2" />

                </div>

                <!-- Remember Me -->
                <div class="mb-6">
                    <label for="remember_me"
                           class="inline-flex items-center">
                        <input id="remember_me"
                               type="checkbox"
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                               name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class=" flex justify-center mb-2">
                    <button class="bg-primary-900 flex-1 p-2 rounded-md font-semibold text-white">Login</button>
                </div>

                <div>
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                           href="{{ route('password.request') }}">
                            {{ __('Lupa Password?') }}
                        </a>
                    @endif
                </div>

                <x-button.register-button>
                    <x-register.dropdown.dropdown-container>

                        <x-register.dropdown.dropdown-link href="{{ route('register') }}">
                            Siswa
                        </x-register.dropdown.dropdown-link>
                        <x-register.dropdown.dropdown-link href="{{ route('register.guru') }}">
                            Guru
                        </x-register.dropdown.dropdown-link>
                        <x-register.dropdown.dropdown-link href="{{ route('register.orang-tua') }}">
                            Orang Tua
                        </x-register.dropdown.dropdown-link>

                    </x-register.dropdown.dropdown-container>
                </x-button.register-button>

            </form>
        </div>
    </div>

</x-guest-layout>

