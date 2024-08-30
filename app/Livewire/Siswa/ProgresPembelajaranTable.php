<?php

namespace App\Livewire\Siswa;

use App\Models\ClassRoom;
use App\Models\ClassRoomStudent;
use App\Models\Materi;
use App\Models\StudentIndikator;
use App\Models\Subject;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProgresPembelajaranTable extends Component
{

    use WithPagination, WithPerPage, WithSearch;

    public $tahunAjaran;
    public $classRoomStudent;

    public $authStudent;

    public function updatedTahunAjaran()
    {
        $this->classRoomStudent = ClassRoomStudent::where('student_id', $this->authStudent->student->id)->where('tahun_ajaran_id', $this->tahunAjaran)->first();

        $this->subjects = Subject::where('class_room_id', $this->classRoomStudent?->class_room_id)->get();
    }

    public $subject;

    public $subjects = [];

    public function updatedSubject()
    {
        $this->materis = Materi::where('subject_id', $this->subject)->get();
    }

    public $materi;

    public $materis = [];

    public function updatedMateri()
    {
        $this->resetPage();
    }

    public function exportPDF()
    {
        if (!$this->materi) {
            return;
        }

        return redirect()->route('siswa.progres-pembelajaran.pdf', $this->materi);
    }

    public function mount()
    {
        $this->authStudent = Auth::user();

        $now = now();

        $this->tahunAjaran = TahunAjaran::where('mulai', '<=', $now)->where('selesai', '>=', $now)->first()->id;

        $this->classRoomStudent = ClassRoomStudent::where('student_id', $this->authStudent->student->id)->where('tahun_ajaran_id', $this->tahunAjaran)->first();

        if ($this->classRoomStudent) {
            $this->subjects = Subject::where('class_room_id', $this->classRoomStudent->class_room_id)->get();
        }
    }


    public function render()
    {
        return view('livewire.siswa.progres-pembelajaran-table', [
            'studentIndikators' => StudentIndikator::query()
                ->whereHas('student', function ($query) {
                    $query->where('id', $this->authStudent->student->id);
                })
                ->whereHas('indikator', function ($query) {
                    $query->whereHas('materi', function ($query) {
                        $query->where('id', $this->materi);
                    });
                })
                ->paginate($this->perPage)
        ]);
    }
}
