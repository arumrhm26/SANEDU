<?php

namespace App\Livewire\Modal;

use App\Models\Subject;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TambahMateriSubject extends ModalComponent
{

    public Subject $subject;

    public $name;

    public function save()
    {

        $this->validate([
            'name' => 'required'
        ]);

        $this->subject->materis()->create([
            'name' => $this->name
        ]);

        $this->closeModal();

        $this->dispatch('refresh-list');
    }


    public function render()
    {
        return view('livewire.modal.tambah-materi-subject');
    }
}
