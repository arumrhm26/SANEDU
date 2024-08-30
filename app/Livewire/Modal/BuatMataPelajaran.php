<?php

namespace App\Livewire\Modal;

use App\Livewire\Admin\User\Kelas\MataPelajaranTable;
use App\Livewire\Forms\BuatMataPelajaran as FormsBuatMataPelajaran;
use App\Livewire\MasterData\MataPelajaranTable as MasterDataMataPelajaranTable;
use App\Models\ClassRoom;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class BuatMataPelajaran extends ModalComponent
{

    public ?ClassRoom $classRoom = null;

    public FormsBuatMataPelajaran $form;

    public function mount()
    {
        if ($this->classRoom) {
            $this->form->class_room_id = $this->classRoom->id;
        }
    }

    public function save()
    {
        $this->form->save();

        $this->closeModalWithEvents([
            MataPelajaranTable::class => ['refresh-list', [
                'message' => 'Mata Pelajaran berhasil ditambahkan',
            ]],
            MasterDataMataPelajaranTable::class => ['refresh-list', [
                'message' => 'Mata Pelajaran berhasil ditambahkan',
            ]],
        ]);
    }


    public function render()
    {
        return view('livewire.modal.buat-mata-pelajaran');
    }
}
