<x-guest-layout>

    <form class="flex justify-center min-h-screen items-center flex-col gap-5 p-5"
          method="POST"
          action="{{ route('register') }}">
        @csrf

        <div class="bg-[#D9D9D9] p-10 rounded-xl min-w-full md:min-w-96 flex flex-col gap-3">

            <h1 class="font-bold text-center text-2xl mb-5">Register Siswa</h1>

            <x-text-input class="form-input border-none rounded-md w-full"
                          name="name"
                          :value="old('name')" />
            <x-input-error :messages="$errors->get('name')" />

            <x-text-input class="form-input border-none rounded-md w-full"
                          name="email"
                          :value="old('email')"
                          type="email" />
            <x-input-error :messages="$errors->get('email')" />

            <x-text-input class="form-input border-none rounded-md w-full"
                          name="asal_sekolah"
                          :value="old('asal_sekolah')"
                          placeholder="Asal Sekolah" />

            <select class="bg-gray-50 text-gray-900 border-none rounded-md w-full"
                    name="cabang"
                    :value="old('cabang')"
                    id="cabang">
                @foreach ($cabang as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>

            <x-text-input class="form-input border-none rounded-md w-full"
                          name="password"
                          id="password"
                          type="password" />
            <x-input-error :messages="$errors->get('password')" />

            <x-text-input class="form-input border-none rounded-md w-full"
                          type="password"
                          name="password_confirmation"
                          id="password-confirmation"
                          placeholder="Konfirmasi Password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />

        </div>
        <div class="min-w-full md:min-w-96 flex">
            <button class="bg-primary-900 flex-1 p-2 rounded-md font-semibold text-white">Register</button>
        </div>
        {{-- Register Ornag Tua Button --}}
        <div class="flex justify-center gap-2">
            <a href="{{ route('register.orang-tua') }}"
               class="text-primary-900 underline">Register Orang Tua</a>
            <a href="{{ route('register.guru') }}"
               class="text-primary-900 underline">Register Guru</a>
        </div>
    </form>

</x-guest-layout>

