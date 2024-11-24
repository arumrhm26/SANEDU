<?php

namespace App\Livewire\Admin\ProgresSiswa;

use App\Exports\ProgresSiswaExport;
use App\Models\ClassRoom;
use App\Models\Materi;
use App\Models\StudentIndikator;
use App\Models\Subject;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithRefreshList;
use App\Traits\WithSearch;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

#[Layout('layouts.admin')]
class RekapanProgresSiswa extends Component
{

    use WithPagination, WithPerPage, WithSearch;

    public $tahunAjaranId;
    public $gradeId;
    public function updatedGradeId()
    {
        $this->classRooms = ClassRoom::query()
            ->where('grade_id', $this->gradeId)
            ->where('tahun_ajaran_id', $this->tahunAjaranId)
            ->get();
        $this->reset('classRoomId', 'subjectId', 'materiId');
    }
    public $classRoomId;
    public $classRooms = [];

    public function updatedClassRoomId()
    {
        $this->subjects = Subject::query()
            ->where('class_room_id', $this->classRoomId)
            ->get();
        $this->reset('subjectId', 'materiId');
    }

    public $subjectId;
    public $subjects = [];

    public function updatedSubjectId()
    {
        $this->materis = Materi::query()
            ->where('subject_id', $this->subjectId)
            ->get();
        $this->reset('materiId');
    }

    public $materiId;
    public $materis = [];

    public function exportPDF()
    {
        if (!$this->materiId) {
            return;
        }

        return redirect()->route('rekapan-progres.pdf', $this->materiId);
    }

    #[On('updated-nilai')]
    public function updatedNilai($studentId, $indikatorId)
    {
        $this->getStudentIndikator($studentId, $indikatorId);
    }


    public function mount()
    {
        $this->perPage = 100;
    }

    public function indikators()
    {
        return Materi::query()
            ->where('id', $this->materiId)
            ->first()
            ->indikators ?? [];
    }

    public function students()
    {
        return ClassRoom::query()
            ->where('id', $this->classRoomId)
            ->first()
            ->students ?? [];
    }

    public function getStudentIndikator($studentId, $indikatorId)
    {
        return StudentIndikator::query()
            ->where('student_id', $studentId)
            ->where('indikator_id', $indikatorId)
            ->first();
    }

    public function render()
    {
        return view('livewire.admin.progres-siswa.rekapan-progres-siswa', []);
    }
}
