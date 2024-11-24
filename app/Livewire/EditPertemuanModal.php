<?php

namespace App\Livewire;

use App\Models\Pertemuan;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditPertemuanModal extends ModalComponent
{

    public Pertemuan $pertemuan;

    public $statuses = [];

    public function updatedStatuses($value, $index)
    {
        $this->statuses[$index] = $value;

        $this->pertemuan->pertemuanStudents()->find($index)->update([
            'pertemuan_status_id' => $value,
        ]);

        $this->dispatch('refresh-list');
    }

    public function save()
    {
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    public function mount(Pertemuan $pertemuan)
    {
        $this->pertemuan = $pertemuan;
        $this->statuses = $this->pertemuan->pertemuanStudents->mapWithKeys(function ($pertemuanStudent) {
            return [$pertemuanStudent->id => $pertemuanStudent->pertemuan_status_id];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.edit-pertemuan-modal');
    }
}
