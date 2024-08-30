<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditUserPassword extends Component
{

    public User $user;

    public string $password = '';
    public string $password_confirmation = '';

    public function rules(): array
    {
        return [
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function save()
    {
        $validated = $this->validate();
        $this->user->password = Hash::make($validated['password']);
        $this->user->save();

        Toaster::success('Password updated successfully');
    }

    public function render()
    {
        return view('livewire.admin.user.edit-user-password');
    }
}
