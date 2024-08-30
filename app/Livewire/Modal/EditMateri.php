<?php

namespace App\Livewire\Modal;

use App\Models\Materi;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditMateri extends ModalComponent
{
    public Materi $materi;

    public $name;

    public function mount(Materi $materi)
    {
        $this->materi = $materi;
        $this->fill($materi);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $this->materi->update([
            'name' => $this->name,
        ]);

        $this->closeModal();

        $this->dispatch('refresh-list');
    }

    public function render()
    {
        return view('livewire.modal.edit-materi');
    }
}
