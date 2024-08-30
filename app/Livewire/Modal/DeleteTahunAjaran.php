<?php

namespace App\Livewire\Modal;

use App\Livewire\Admin\User\TahunAjaranTable;
use App\Models\TahunAjaran;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteTahunAjaran extends ModalComponent
{

    public TahunAjaran $tahunAjaran;

    public function delete()
    {

        $this->tahunAjaran->classRooms()->delete();

        $this->tahunAjaran->delete();

        $this->closeModalWithEvents(
            [
                TahunAjaranTable::class => ["refresh-list", ["message" => "Data tahun ajaran berhasil dihapus"]],
            ]
        );
    }

    public function render()
    {
        return view('livewire.modal.delete-tahun-ajaran');
    }
}
