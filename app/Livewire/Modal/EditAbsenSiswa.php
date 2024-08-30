<?php

namespace App\Livewire\Modal;

use App\Models\PertemuanStudent;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditAbsenSiswa extends Component
{

    public ?PertemuanStudent $pertemuanStudent;

    public $status;

    #[On('open-modal')]
    public function openModal(PertemuanStudent $pertemuanStudent, $component)
    {
        if ($component !== 'edit-absen-siswa') {
            return;
        }

        $this->pertemuanStudent = $pertemuanStudent;
        $this->status = $pertemuanStudent->pertemuanStatus->id;
    }

    #[On('close-modal')]
    public function closeModal()
    {
        $this->pertemuanStudent = new PertemuanStudent();

        $this->reset('status');
    }

    public function save()
    {
        $this->validate([
            'status' => 'required|exists:pertemuan_statuses,id',
        ]);

        $this->pertemuanStudent->update([
            'pertemuan_status_id' => $this->status,
        ]);

        $this->dispatch('close-modal', component: 'edit-absen-siswa');
        Toaster::success('Absen berhasil diubah');
        $this->dispatch('refresh-list');
    }

    public function render()
    {
        return view('livewire.modal.edit-absen-siswa');
    }
}
