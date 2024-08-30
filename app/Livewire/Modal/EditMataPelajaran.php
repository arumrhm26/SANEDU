<?php

namespace App\Livewire\Modal;

use App\Models\ClassRoom;
use App\Models\Subject;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditMataPelajaran extends ModalComponent
{
    public Subject $subject;
    public ClassRoom $classRoom;

    public $name;
    public $teacher_id;

    public function mount(Subject $subject)
    {
        $this->fill($subject->toArray());
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $this->subject->update([
            'name' => $this->name,
            'teacher_id' => $this->teacher_id,
        ]);

        $this->dispatch('refresh-list');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modal.edit-mata-pelajaran');
    }
}
