<?php

namespace App\Livewire\Modal;

use App\Livewire\Admin\DetailTahunAjaran;
use App\Livewire\Forms\EditKelas as FormsEditKelas;
use App\Models\ClassRoom;
use LivewireUI\Modal\ModalComponent;

class EditKelas extends ModalComponent
{

    public ClassRoom $classRoom;

    public FormsEditKelas $form;

    public function mount(ClassRoom $classRoom)
    {
        $this->classRoom = $classRoom;
        $this->form->setClassRoom($classRoom);
    }

    public function save()
    {
        $this->form->save();
        $this->closeModalWithEvents(
            [
                DetailTahunAjaran::class => ["refresh-list", ["message" => "Data kelas berhasil diubah"]],
            ]
        );
    }

    public function render()
    {
        return view('livewire.modal.edit-kelas');
    }
}
