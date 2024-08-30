<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditUserSiswa extends Component
{
    public User $user;

    public string $asal_sekolah = '';
    public string $cabang_id = '';

    public function rules(): array
    {
        return [
            'asal_sekolah' => 'required|string|max:255',
            'cabang_id' => 'required|numeric|exists:cabangs,id',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->user->student === null) {
            $this->user->student()->create($validated);
            Toaster::success('Profile updated successfully');
            return;
        }

        $this->user->student->fill($validated);
        $this->user->student->save();
        Toaster::success('Profile updated successfully');
    }

    public function mount()
    {
        $this->fill([
            'asal_sekolah' => $this->user->student->asal_sekolah ?? '',
            'cabang_id' => $this->user->student->cabang_id ?? '',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.user.edit-user-siswa');
    }
}
