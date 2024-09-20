<x-guest-layout>

    <form class="flex justify-center min-h-screen items-center flex-col gap-5 p-5"
          method="POST"
          action="{{ route('register') }}">
        @csrf

        <div class="bg-[#D9D9D9] p-10 rounded-xl min-w-full md:min-w-96 flex flex-col gap-3">

            <h1 class="font-bold text-center text-2xl mb-5">Register Orang Tua</h1>

            <x-text-input class="form-input border-none rounded-md w-full"
                          :value="old('name')"
                          name="name" />
            <x-input-error :messages="$errors->get('name')"
                           class="-mt-2" />

            <x-text-input class="form-input border-none rounded-md w-full"
                          :value="old('email')"
                          type="email"
                          name="email" />
            <x-input-error :messages="$errors->get('email')"
                           class="-mt-2" />

            <x-text-input class="form-input border-none rounded-md w-full"
                          name="student_email"
                          :value="old('student_email')"
                          type="email"
                          placeholder="Email Siswa" />
            <x-input-error :messages="$errors->get('student_email')"
                           class="-mt-2" />

            <x-text-input class="form-input border-none rounded-md w-full"
                          name="hubungan"
                          :value="old('hubungan')"
                          placeholder="Hubungan Dengan Siswa" />
            <x-input-error :messages="$errors->get('hubungan')"
                           class="-mt-2" />

            <x-text-input class="form-input border-none rounded-md w-full"
                          name="password"
                          id="password"
                          type="password" />
            <x-input-error :messages="$errors->get('password')"
                           class="-mt-2" />

            <x-text-input class="form-input border-none rounded-md w-full"
                          name="password_confirmation"
                          id="password-confirmation"
                          placeholder="Konfirmasi Password"
                          type="password" />
            <x-input-error :messages="$errors->get('password_confirmation')"
                           class="-mt-2" />

        </div>
        <div class="min-w-full md:min-w-96 flex">
            <button class="bg-primary-900 flex-1 p-2 rounded-md font-semibold text-white">Register</button>
        </div>

        {{-- Register Ornag Tua Button --}}
        <div class="flex justify-center gap-2">
            <a href="{{ route('register') }}"
               class="text-primary-900 underline">Register Siswa</a>
            <a href="{{ route('register.guru') }}"
               class="text-primary-900 underline">Register Tentor</a>
        </div>
    </form>

</x-guest-layout>

