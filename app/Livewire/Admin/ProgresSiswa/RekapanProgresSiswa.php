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
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

#[Layout('layouts.admin')]
class RekapanProgresSiswa extends Component
{

    use WithPagination, WithPerPage, WithRefreshList, WithSearch;

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

    public function exportExcel()
    {

        if (!$this->materiId) {
            return;
        }

        $tahunAjaranName = TahunAjaran::find($this->tahunAjaranId)->name;
        // replace "/" in tahun ajaran name
        $tahunAjaranName = str_replace('/', '-', $tahunAjaranName);
        $classRoomName = ClassRoom::find($this->classRoomId)->full_name;
        $subjectName = Subject::find($this->subjectId)->name;
        $materiName = Materi::find($this->materiId)->name;

        $fileName = "{$tahunAjaranName}_{$classRoomName}_{$subjectName}_{$materiName}.xlsx";

        return (new ProgresSiswaExport)->forMateriId($this->materiId)->download($fileName);
    }

    public function exportPDF()
    {
        if (!$this->materiId) {
            return;
        }

        return redirect()->route('rekapan-progres.pdf', $this->materiId);
    }

    public function mount()
    {
        $this->perPage = 100;
    }

    public function render()
    {
        return view('livewire.admin.progres-siswa.rekapan-progres-siswa', [
            'studentIndikators' => StudentIndikator::with(['student', 'indikator'])
                ->whereHas('indikator', function ($query) {
                    $query->where('materi_id', $this->materiId);
                    $query->whereLike('name', "%$this->search%");
                })
                ->paginate($this->perPage),
        ]);
    }
}
