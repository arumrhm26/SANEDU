<?php

namespace App\Livewire\Modal;

use App\Models\StudentIndikator;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditProgresSiswa extends Component
{

    public ?StudentIndikator $studentIndikator;

    public $nilai;

    #[On('open-modal')]
    public function openModal(StudentIndikator $studentIndikator, $component)
    {
        if ($component !== 'edit-progres-siswa') {
            return;
        }

        $this->studentIndikator = $studentIndikator;
        $this->nilai = $studentIndikator->nilai;
    }

    #[On('close-modal')]
    public function closeModal()
    {
        $this->studentIndikator = new StudentIndikator();

        $this->reset('nilai');
    }

    public function save()
    {
        $this->validate([
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        $this->studentIndikator->update([
            'nilai' => $this->nilai,
        ]);

        $this->dispatch('close-modal', component: 'edit-progres-siswa');
        Toaster::success('Progres berhasil diubah');
        $this->dispatch('refresh-list');
    }


    public function render()
    {
        return view('livewire.modal.edit-progres-siswa');
    }
}
