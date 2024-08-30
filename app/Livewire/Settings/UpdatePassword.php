<?php

namespace App\Livewire\Settings;

use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class UpdatePassword extends Component
{

    public $current_password;

    public $password;

    public $password_confirmation;

    /**
     * Summary of updatePassword
     * @return void
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }


        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);


        $this->reset('current_password', 'password', 'password_confirmation');

        Toaster::success('Password updated successfully');
    }

    public function render()
    {
        return view('livewire.settings.update-password');
    }
}
