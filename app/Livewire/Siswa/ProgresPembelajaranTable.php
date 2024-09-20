<?php

namespace App\Livewire\Siswa;

use App\Models\Cabang;
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

    public $isDouble;

    public $cabang;

    public $classRoomStudent;

    public $authStudent;

    public function updatedTahunAjaran()
    {


        $this->classRoomStudent = ClassRoomStudent::query()
            ->where('student_id', $this->authStudent->student->id)
            ->where('tahun_ajaran_id', $this->tahunAjaran)
            ->whereHas(
                'classRoom',
                function ($query) {
                    $query->where('cabang_id', $this->cabang);
                }
            )
            ->first();

        $this->subjects = Subject::where('class_room_id', $this->classRoomStudent?->class_room_id)->get();

        $this->reset('subject');
    }

    public $cabangs;

    public function updatedCabang()
    {

        $this->classRoomStudent = ClassRoomStudent::query()
            ->where('student_id', $this->authStudent->student->id)
            ->where('tahun_ajaran_id', $this->tahunAjaran)
            ->whereHas(
                'classRoom',
                function ($query) {
                    $query->where('cabang_id', $this->cabang);
                }
            )
            ->first();


        $this->subjects = Subject::where('class_room_id', $this->classRoomStudent?->class_room_id)->get();
    }

    public $subject;

    public $subjects = [];


    public function exportPDF()
    {
        if (!$this->subject) {
            return;
        }

        $subject = Subject::find($this->subject);

        return redirect()->route('siswa.progres-pembelajaran.pdf', $subject);
    }

    public function mount()
    {
        $this->authStudent = Auth::user();

        $this->isDouble = false;

        $this->cabangs = Cabang::all();

        $now = now();

        $this->tahunAjaran = TahunAjaran::where('mulai', '<=', $now)->where('selesai', '>=', $now)->first()->id;

        $this->classRoomStudent = ClassRoomStudent::where('student_id', $this->authStudent->student->id)->where('tahun_ajaran_id', $this->tahunAjaran)->first();


        if ($this->classRoomStudent) {

            // cek apakah classroom student lebih dari 1
            $this->isDouble = ClassRoomStudent::where('student_id', $this->authStudent->student->id)->where('tahun_ajaran_id', $this->tahunAjaran)->count() > 1;

            $this->cabang = $this->classRoomStudent->classRoom->cabang_id;
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
                ->whereHas('indikator.materi.subject', function ($query) {
                    $query->where('id', $this->subject);
                })
                ->paginate($this->perPage)
        ]);
    }
}
