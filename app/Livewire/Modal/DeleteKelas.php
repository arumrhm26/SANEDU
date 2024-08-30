<?php

namespace App\Livewire\Modal;

use App\Livewire\Admin\DetailTahunAjaran;
use App\Models\ClassRoom;
use LivewireUI\Modal\ModalComponent;

class DeleteKelas extends ModalComponent
{
    public ClassRoom $classRoom;

    public function delete()
    {
        // $this->classRoom->students()->delete();
        $this->classRoom->delete();

        $this->closeModalWithEvents(
            [
                DetailTahunAjaran::class => ["refresh-list", ["message" => "Data kelas berhasil dihapus"]],
            ]
        );
    }

    public function render()
    {
        return view('livewire.modal.delete-kelas');
    }
}
