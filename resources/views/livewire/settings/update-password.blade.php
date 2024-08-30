<section class="mt-8">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Ganti Password') }}
        </h2>
    </header>

    <form class="space-y-6 mt-4"
          wire:submit='updatePassword'>

        <div>
            <x-input-label for="update_password_current_password"
                           :value="__('Password')" />
            <x-text-input id="update_password_current_password"
                          name="current_password"
                          type="password"
                          wire:model="current_password"
                          class="mt-1 block w-full"
                          placeholder="Password" />
            <x-input-error :messages="$errors->get('current_password')"
                           class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password"
                           :value="__('Password Baru')" />
            <x-text-input id="update_password_password"
                          name="password"
                          type="password"
                          placeholder="Password Baru"
                          wire:model="password"
                          class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('password')"
                           class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation"
                           :value="__('Kofirmasi Password Baru')" />
            <x-text-input id="update_password_password_confirmation"
                          name="password_confirmation"
                          type="password"
                          placeholder="Konfirmasi Password Baru"
                          wire:model="password_confirmation"
                          class="mt-1 block w-full"
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')"
                           class="mt-2" />
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

