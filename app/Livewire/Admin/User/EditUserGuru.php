<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditUserGuru extends Component
{

    public User $user;

    public string $rekening_bank = '';
    public string $no_rekening = '';
    public string $no_wa = '';

    public function rules(): array
    {
        return [
            'rekening_bank' => 'required|string|max:255',
            'no_rekening' => 'required|numeric',
            'no_wa' => 'required|numeric',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->user->teacher === null) {
            $this->user->teacher()->create($validated);
            Toaster::success('Profile updated successfully');
            return;
        }

        $this->user->teacher->fill($validated);
        $this->user->teacher->save();
        Toaster::success('Profile updated successfully');
    }

    public function mount()
    {
        $this->fill(
            [
                'rekening_bank' => $this->user->teacher->rekening_bank ?? '',
                'no_rekening' => $this->user->teacher->no_rekening ?? '',
                'no_wa' => $this->user->teacher->no_wa ?? '',
            ]
        );
    }

    public function render()
    {
        return view('livewire.admin.user.edit-user-guru');
    }
}
