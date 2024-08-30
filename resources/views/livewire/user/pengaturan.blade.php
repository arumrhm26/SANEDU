<div class="p-5 max-w-screen-sm mx-auto">

    <div class="mb-4">
        {{ Breadcrumbs::render('settings') }}
    </div>

    <h1 class="font-bold text-2xl ">Pengaturan</h1>

    <div class="mt-4">
        <section class="">
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Informasi Akun') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Perbarui informasi akun anda') }}
                </p>
            </header>

            <form class="mt-6 space-y-6"
                  wire:submit="updateProfileInformation">

                <div>
                    <x-input-label for="name"
                                   :value="__('Nama')" />
                    <x-text-input class="mt-1 block w-full"
                                  id="name"
                                  name="name"
                                  type="text"
                                  required
                                  wire:model="name" />
                    <x-input-error class="mt-2"
                                   :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email"
                                   :value="__('Email')" />

                    <x-text-input class="mt-1 block w-full"
                                  id="email"
                                  name="email"
                                  type="email"
                                  required
                                  wire:model="email" />
                    <x-input-error class="mt-2"
                                   :messages="$errors->get('email')" />
                    <div wire:dirty
                         wire:target='email'>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Catatan : jika anda mengganti email anda maka anda perlu melakukan verifikasi email kembali') }}
                        </p>
                    </div>

                    @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800">
                                {{ __('Email anda belum terverifikasi.') }}

                                <a wire:click.prevent="sendVerification"
                                   class="underline text-sm text-gray-600 hover:text-gray-900 cursor-pointer">
                                    {{ __('Click disini untuk mengirim email verifikasi') }}
                                </a>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    {{ __('Email verifikasi berhasil dikirim') }}
                                </p>
                            @endif

                        </div>
                    @endif
                    <x-input-error class="mt-2"
                                   :messages="$errors->get('limit')" />
                </div>

                <div class="flex items-center justify-end gap-4">
                    <x-primary-button class="text-sm disabled:opacity-50">
                        {{ __('Simpan') }}
                        <div wire:loading>
                            <x-icons.dot-loading class="text-white" />
                        </div>
                    </x-primary-button>
                </div>
            </form>
        </section>

        @role('siswa')
            <livewire:settings.update-profil-siswa />
        @endrole

        <livewire:settings.update-password />

    </div>

</div>

