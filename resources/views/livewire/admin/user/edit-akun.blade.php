<section>
    <h1 class="text-xl font-bold">Detail akun</h1>
    <hr class="h-px bg-gray-200 mt-1 mb-4 border-0">
    <form wire:submit='updateProfileInformation'>

        <div class="flex flex-col md:flex-row gap-4 ">
            <div class="flex gap-1 flex-col w-full">
                <x-input-label value="Nama"
                               for="name"
                               class="font-semibold" />
                <div>

                    <x-text-input id="name"
                                  wire:model="name"
                                  type="text" />
                    <x-input-error class="mt-2"
                                   :messages="$errors->get('email')" />

                </div>
            </div>
            <div class="flex gap-1 flex-col w-full">
                <x-input-label value="Email"
                               for="email"
                               class="font-semibold" />
                <div>
                    <x-text-input id="email"
                                  wire:model="email"
                                  type="email" />

                    {{-- email verification --}}
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800">
                                {{ __('Email belum terverifikasi.') }}
                                <s wire:click.prevent="sendVerification"
                                   class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md cursor-pointer">
                                    {{ __('Click disini untuk mengirim email verifikasi') }}
                                </s>
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
                    <x-input-error class="mt-2"
                                   :messages="$errors->get('email')" />

                </div>
            </div>
        </div>
        <div class="flex items-center justify-end gap-4 mt-2">
            <x-primary-button class="text-sm disabled:opacity-50">
                {{ __('Simpan') }}
                <div wire:loading>
                    <x-icons.dot-loading class="text-white" />
                </div>
            </x-primary-button>
        </div>
    </form>

</section>

