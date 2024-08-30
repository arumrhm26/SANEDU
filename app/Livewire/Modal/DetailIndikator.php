<?php

namespace App\Livewire\Modal;

use App\Models\Indikator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DetailIndikator extends ModalComponent
{

    public Indikator $indikator;

    public $studentNilais;

    public function mount(Indikator $indikator)
    {
        $this->indikator = $indikator;

        // get all nilai and if from studentIndikators in indikator
        $this->studentNilais = $this->indikator->studentIndikators->pluck('nilai', 'id');
    }

    public function save()
    {

        // verify if studentNilais is empty
        $this->validate([
            'studentNilais.*' => 'required|numeric|min:0|max:100'
        ]);

        // update studentIndikators
        foreach ($this->studentNilais as $studentIndikatorId => $nilai) {
            DB::beginTransaction();
            try {
                $studentIndikator = $this->indikator->studentIndikators()->find($studentIndikatorId);
                $studentIndikator->update([
                    'nilai' => $nilai
                ]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->addError('studentNilais', 'Failed to update nilai');
            }
        }

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modal.detail-indikator', [
            'studentIndikators' => $this->indikator->studentIndikators()
                ->with('student')
                ->whereHas('student', function ($query) {
                    $query->whereHas('classRoomStudents', function ($query) {
                        $query->where('class_room_id', $this->indikator->materi->subject->classRoom->id);
                    });
                })
                ->get()
        ]);
    }
}
