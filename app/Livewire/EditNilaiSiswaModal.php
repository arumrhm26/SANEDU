<?php

namespace App\Livewire;

use App\Models\Materi;
use App\Models\Student;
use App\Models\StudentIndikator;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditNilaiSiswaModal extends ModalComponent
{

    public Student $student;
    public Materi $materi;

    public $indikators = [];

    public $nilais = [];


    public function save()
    {

        foreach ($this->nilais as $indikatorId => $nilai) {
            $studentIndikator = StudentIndikator::query()
                ->where('student_id', $this->student->id)
                ->where('indikator_id', $indikatorId)
                ->first();

            if ($studentIndikator) {
                $studentIndikator->update([
                    'nilai' => $nilai > 100 ? 100 : $nilai,
                ]);

                $studentIndikator->save();

                $this->dispatch(
                    'updated-nilai',
                    studentId: $this->student->id,
                    indikatorId: $indikatorId
                );
            }
        }



        $this->closeModal();
    }

    public function mount(Student $student, Materi $materi)
    {
        $this->student = $student;
        $this->materi = $materi;

        $this->nilais = StudentIndikator::query()
            ->where('student_id', $student->id)
            ->whereHas(
                'indikator.materi',
                function ($query) use ($materi) {
                    $query->where('id', $materi->id);
                }
            )
            ->get()
            ->mapWithKeys(function ($indikator) {
                return [$indikator->indikator->id => $indikator->nilai];
            })
            ->toArray();

        $this->indikators = $materi->indikators;
    }

    public function render()
    {
        return view('livewire.edit-nilai-siswa-modal');
    }
}
