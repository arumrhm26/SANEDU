<?php

namespace App\Livewire\Modal;

use App\Livewire\Admin\User\GuruTable;
use App\Livewire\Forms\EditGuru as FormsEditGuru;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class EditGuru extends ModalComponent
{

    public User $user;
    public FormsEditGuru $forms;

    public function save()
    {
        $this->forms->save();
        $this->closeModalWithEvents(
            [
                GuruTable::class => ["refresh-list", ["message" => "Data guru berhasil diubah"]],
            ]
        );
    }

    public function mount()
    {
        $this->forms->setUser($this->user);
    }


    public function render()
    {
        return view('livewire.modal.edit-guru');
    }
}
