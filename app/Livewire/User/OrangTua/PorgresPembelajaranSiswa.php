<?php

namespace App\Livewire\User\OrangTua;

use App\Models\Cabang;
use App\Models\ClassRoomStudent;
use App\Models\Materi;
use App\Models\Student;
use App\Models\StudentIndikator;
use App\Models\Subject;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.user')]
class PorgresPembelajaranSiswa extends Component
{


    use WithPagination, WithPerPage, WithSearch;

    public $tahunAjaran;

    public $cabang;

    public $isDouble;

    public $classRoomStudent;

    public $authStudent;

    public function updatedTahunAjaran()
    {

        $this->classRoomStudent = ClassRoomStudent::query()
            ->where('student_id', $this->authStudent->id)
            ->where('tahun_ajaran_id', $this->tahunAjaran)
            ->whereHas(
                'classRoom',
                function ($query) {
                    $query->where('cabang_id', $this->cabang);
                }
            )
            ->first();

        if ($this->classRoomStudent)
            $this->subjects = Subject::where('class_room_id', $this->classRoomStudent->class_room_id)->get();

        $this->reset('subject');

        // $this->subjects = Subject::where('class_room_id', $this->classRoomStudent->class_room_id)->get();
    }

    public $cabangs;

    public function updatedCabang()
    {

        $this->classRoomStudent = ClassRoomStudent::query()
            ->where('student_id', $this->authStudent->id)
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
        // $this->authStudent = Auth::user();

        $this->authStudent = Student::where(
            'user_id',
            Auth::user()->studentParent->child->id
        )->first();

        $this->isDouble = false;

        $this->cabangs = Cabang::all();


        $now = now();

        $this->tahunAjaran = TahunAjaran::where('mulai', '<=', $now)->where('selesai', '>=', $now)->first()->id;

        $this->classRoomStudent = ClassRoomStudent::where('student_id', $this->authStudent->id)->where('tahun_ajaran_id', $this->tahunAjaran)->first();

        if ($this->classRoomStudent) {

            // cek apakah classroom student lebih dari 1?
            $this->isDouble = ClassRoomStudent::where('student_id', $this->authStudent->id)->where('tahun_ajaran_id', $this->tahunAjaran)->count() > 1;

            $this->cabang = $this->classRoomStudent->classRoom->cabang_id;
            $this->subjects = Subject::where('class_room_id', $this->classRoomStudent->class_room_id)->get();
        }
    }



    public function render()
    {
        return view('livewire.user.orang-tua.porgres-pembelajaran-siswa', [
            'studentIndikators' => StudentIndikator::query()
                ->whereHas('student', function ($query) {
                    $query->where('id', $this->authStudent->id);
                })
                ->whereHas('indikator.materi.subject', function ($query) {
                    $query->where('id', $this->subject);
                })
                ->paginate($this->perPage)
        ]);
    }
}
