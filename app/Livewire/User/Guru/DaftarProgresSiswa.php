<?php

namespace App\Livewire\User\Guru;

use App\Models\Student;
use App\Models\StudentIndikator;
use App\Models\Subject;
use App\Traits\WithPerPage;
use App\Traits\WithRefreshList;
use App\Traits\WithSearch;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.user')]
class DaftarProgresSiswa extends Component
{

    use WithPagination, WithPerPage, WithRefreshList, WithSearch;

    public Subject $subject;
    public Student $student;

    public function render()
    {
        return view('livewire.user.guru.daftar-progres-siswa', [
            'studentIndikators' => StudentIndikator::query()
                ->where('student_id', $this->student->id)
                ->whereHas('indikator.materi.subject', function ($query) {
                    $query->where('id', $this->subject->id);
                })
                ->paginate($this->perPage),
        ]);
    }
}
