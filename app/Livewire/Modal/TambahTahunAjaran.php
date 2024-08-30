<?php

namespace App\Livewire\Modal;

use App\Livewire\Admin\User\TahunAjaranTable;
use App\Livewire\Forms\TambahTahunAjaran as FormsTambahTahunAjaran;
use LivewireUI\Modal\ModalComponent;

class TambahTahunAjaran extends ModalComponent
{

    public FormsTambahTahunAjaran $form;

    public function save()
    {
        $created = $this->form->save();

        if (!$created) {
            return;
        }

        $this->closeModalWithEvents(
            [
                TahunAjaranTable::class => ["refresh-list", ["message" => "Data tahun ajaran berhasil ditambahkan"]],
            ]
        );
    }

    public function render()
    {
        return view('livewire.modal.tambah-tahun-ajaran');
    }
}
