<?php

namespace App\Livewire\Modal;

use App\Jobs\ImportTahunAjaran;
use App\Livewire\Admin\User\TahunAjaranTable;
use App\Models\TahunAjaran;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ImportDataTahunAjaran extends ModalComponent
{


    public TahunAjaran $tahunAjaran;

    public $importOptions = [];

    public function save()
    {

        // dd($this->importOptions);

        if ($this->importOptions) {

            dispatch(new ImportTahunAjaran($this->tahunAjaran, $this->importOptions));
        }

        $this->closeModalWithEvents(
            [
                TahunAjaranTable::class => ["refresh-list", ["message" => "Data tahun ajaran berhasil di import"]],
            ]
        );
    }

    public function render()
    {
        return view('livewire.modal.import-data-tahun-ajaran');
    }
}
