<?php

namespace App\Livewire\Modal;

use App\Livewire\Forms\TambahIndikator as FormsTambahIndikator;
use App\Models\ClassRoom;
use App\Models\Materi;
use App\Models\Subject;
use LivewireUI\Modal\ModalComponent;

class TambahIndikator extends ModalComponent
{

    public FormsTambahIndikator $form;

    public Materi|null $selectedMateri = null;

    public $classRoom = null;
    public function updatedClassRoom()
    {
        $this->subjects = Subject::where('class_room_id', $this->classRoom)->get();
    }

    public $subjects = [];
    public $subjectId = '';
    public function updatedSubjectId()
    {
        $this->materis = Materi::where('subject_id', $this->subjectId)->get();
    }

    public $materis = [];

    public function save()
    {
        $this->form->save();

        $this->closeModal();

        $this->dispatch('refresh-list');
    }

    public function mount()
    {
        // dd($selectedMateri ? "ada" : "tidak ada");

        if ($this->selectedMateri != null) {
            $this->classRoom = $this->selectedMateri->subject->class_room_id;
            $this->subjectId = $this->selectedMateri->subject_id;
            $this->subjects = Subject::where('class_room_id', $this->classRoom)->get();
            $this->materis = Materi::where('subject_id', $this->subjectId)->get();
            $this->form->materi_id = $this->selectedMateri->id;
        }
    }

    public function render()
    {
        return view('livewire.modal.tambah-indikator');
    }
}
