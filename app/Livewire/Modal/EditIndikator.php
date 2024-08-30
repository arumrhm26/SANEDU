<?php

namespace App\Livewire\Modal;

use App\Models\Indikator;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditIndikator extends ModalComponent
{

    public Indikator $indikator;
    public $name;

    public function mount(Indikator $indikator)
    {
        $this->indikator = $indikator;
        $this->fill($indikator);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required'
        ]);

        $this->indikator->update([
            'name' => $this->name
        ]);

        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    public function render()
    {
        return view('livewire.modal.edit-indikator');
    }
}
