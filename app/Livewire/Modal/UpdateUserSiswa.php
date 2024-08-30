<?php

namespace App\Livewire\Modal;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateUserSiswa extends Component
{

    public User $user;

    #[On('open-modal')]
    public function openModal(User $user)
    {
        $this->user = $user;
    }


    public function render()
    {
        return view('livewire.modal.update-user-siswa');
    }
}
