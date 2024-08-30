<?php

namespace App\Livewire\Modal;

use App\Livewire\Forms\TambahMateri as FormsTambahMateri;
use App\Models\Subject;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TambahMateri extends ModalComponent
{
    public FormsTambahMateri $form;

    public $classRoom = '';
    public function updatedClassRoom()
    {
        $this->form->subjects = Subject::where('class_room_id', $this->classRoom)->get();
    }

    public function save()
    {

        $this->form->save();

        $this->closeModal();

        $this->dispatch('refresh-list');
    }


    public function render()
    {
        return view('livewire.modal.tambah-materi');
    }
}
