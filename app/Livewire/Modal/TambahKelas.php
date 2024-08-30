<?php

namespace App\Livewire\Modal;

use App\Livewire\Admin\DetailTahunAjaran;
use App\Livewire\Forms\TambahKelas as FormsTambahKelas;
use App\Models\TahunAjaran;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TambahKelas extends ModalComponent
{

    public FormsTambahKelas $form;

    public TahunAjaran $tahunAjaran;

    public function save()
    {
        $this->form->tahun_ajaran_id = $this->tahunAjaran->id;
        $this->form->save();
        $this->closeModalWithEvents(
            [
                DetailTahunAjaran::class => ["refresh-list", ["message" => "Data kelas berhasil ditambahkan"]],
            ]
        );
    }


    public function render()
    {
        return view('livewire.modal.tambah-kelas');
    }
}
