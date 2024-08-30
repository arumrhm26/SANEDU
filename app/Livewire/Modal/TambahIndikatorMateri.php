<?php

namespace App\Livewire\Modal;

use App\Jobs\IndikatorAddeddToClassRoom;
use App\Jobs\StudentAddeddToClassRoom;
use App\Models\Materi;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TambahIndikatorMateri extends ModalComponent
{

    public Materi $materi;

    public $name;

    public function save()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $createdIndikator = $this->materi->indikators()->create([
            'name' => $this->name,
            'code' => $this->materi->indikators->count() + 1,
        ]);

        if (!$createdIndikator) {
            return;
        }

        dispatch(new IndikatorAddeddToClassRoom($this->materi->subject->classRoom, $createdIndikator));


        $this->closeModal();
        $this->dispatch('refresh-list');
    }


    public function render()
    {
        return view('livewire.modal.tambah-indikator-materi');
    }
}
