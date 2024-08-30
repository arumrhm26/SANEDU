<?php

namespace App\Livewire\Modal;

use App\Livewire\Admin\User\TahunAjaranTable;
use App\Models\TahunAjaran;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditTahunAjaran extends ModalComponent
{


    public TahunAjaran $tahunAjaran;

    public $name;
    public $mulai;
    public $selesai;

    public function mount(TahunAjaran $tahunAjaran)
    {
        $this->tahunAjaran = $tahunAjaran;
        $this->fill($tahunAjaran->toArray());
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:tahun_ajarans,name,' . $this->tahunAjaran->id,
            'mulai' => 'required|date|unique:tahun_ajarans,mulai,' . $this->tahunAjaran->id,
            'selesai' => 'required|date|after:mulai|unique:tahun_ajarans,selesai,' . $this->tahunAjaran->id,
        ]);



        // check id mulai is older than latest selesai except for current id
        $latestTahunAjaran = TahunAjaran::where('id', '!=', $this->tahunAjaran->id)->orderBy('selesai', 'desc')->first();

        if ($latestTahunAjaran && $latestTahunAjaran->selesai > $this->mulai) {
            $this->addError('mulai', 'Tanggal mulai harus lebih besar dari tanggal selesai tahun ajaran sebelumnya (' . $latestTahunAjaran->selesai . ')');
            return false;
        }

        $this->tahunAjaran->update([
            'name' => $this->name,
            'mulai' => $this->mulai,
            'selesai' => $this->selesai,
        ]);

        $this->closeModalWithEvents(
            [
                TahunAjaranTable::class => ["refresh-list", ["message" => "Data tahun ajaran berhasil diubah"]],
            ]
        );
    }

    public function render()
    {
        return view('livewire.modal.edit-tahun-ajaran');
    }
}
