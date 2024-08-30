<?php

namespace App\Livewire\Modal;

use App\Livewire\Admin\User\OrangtuaTable;
use App\Livewire\Forms\EditOrangtua as FormsEditOrangtua;
use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditOrangtua extends ModalComponent
{

    public ?User $user;

    public FormsEditOrangtua $forms;

    public function mount()
    {
        $this->forms->setUser($this->user);
    }

    public function save()
    {
        $this->forms->save();
        $this->closeModalWithEvents(
            [
                OrangtuaTable::class => ["refresh-list", ["message" => "Data orangtua berhasil diubah"]],
            ]
        );
    }


    public function render()
    {
        return view('livewire.modal.edit-orangtua');
    }
}
