<x-guest-layout>

    <form class="flex justify-center min-h-screen items-center flex-col gap-5 p-5"
          method="POST"
          action="{{ route('register') }}">
        @csrf

        <div class="bg-[#D9D9D9] p-10 rounded-xl min-w-full md:min-w-96 flex flex-col gap-3">

            <h1 class="font-bold text-center text-2xl mb-5">Register Tentor</h1>

            <x-text-input class="form-input border-none rounded-md w-full"
                          name="name"
                          :value="old('name')"
                          placeholder="Nama" />
            <x-input-error :messages="$errors->get('name')" />

            <x-text-input class="form-input border-none rounded-md w-full"
                          :value="old('email')"
                          type="email"
                          name="email" />
            <x-input-error :messages="$errors->get('email')" />

            <x-text-input class="form-input border-none rounded-md w-full"
                          name="rekening_bank"
                          :value="old('rekening_bank')"
                          placeholder="Rekening Bank" />
            <x-input-error :messages="$errors->get('rekening_bank')" />

            <x-text-input class="form-input border-none rounded-md w-full"
                          name="no_rekening"
                          :value="old('no_rekening')"
                          placeholder="No Rekening" />
            <x-input-error :messages="$errors->get('no_rekening')" />

            <x-text-input class="form-input border-none rounded-md w-full"
                          name="no_wa"
                          :value="old('no_wa')"
                          placeholder="No WhatsApp" />
            <x-input-error :messages="$errors->get('no_wa')" />

            <x-text-input class="form-input border-none rounded-md w-full"
                          name="password"
                          id="password"
                          type="password" />
            <x-input-error :messages="$errors->get('password')" />

            <x-text-input class="form-input border-none rounded-md w-full"
                          name="password_confirmation"
                          placeholder="Konfirmasi Password"
                          id="password-confirmation"
                          type="password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />

        </div>
        <div class="min-w-full md:min-w-96 flex">
            <button class="bg-primary-900 flex-1 p-2 rounded-md font-semibold text-white">Register</button>
        </div>
        {{-- Register Ornag Tua Button --}}
        <div class="flex justify-center gap-2">
            <a href="{{ route('register') }}"
               class="text-primary-900 underline">Register Siswa</a>
            <a href="{{ route('register.orang-tua') }}"
               class="text-primary-900 underline">Register Orang Tua</a>
        </div>
    </form>

</x-guest-layout>

