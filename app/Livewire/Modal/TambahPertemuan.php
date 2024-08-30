<?php

namespace App\Livewire\Modal;

use App\Jobs\PertemuanCreated;
use App\Livewire\Admin\Absen\PertemuanAbsen;
use App\Models\Materi;
use App\Models\Pertemuan;
use App\Models\PertemuanStudent;
use App\Models\Student;
use App\Models\Subject;
use LivewireUI\Modal\ModalComponent;

class TambahPertemuan extends ModalComponent
{
    public $tahunAjaranId;

    public $classRoomId;
    public function updatedClassRoomId()
    {
        $this->subjects = Subject::where('class_room_id', $this->classRoomId)->get();
        $this->subjectId = null;
        $this->materiId = null;
    }


    public $subjectId;
    public $subjects = [];
    public function updatedSubjectId()
    {
        $this->materis = Materi::where('subject_id', $this->subjectId)->get();
        $this->materiId = null;
    }

    public $materiId;
    public $materis = [];

    public $tanggal;
    public $waktu_mulai;
    public $waktu_selesai;

    public function rules()
    {
        return [
            'materiId' => 'required|exists:materis,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ];
    }

    public function create()
    {
        $this->validate();

        $pertemuan = Pertemuan::create([
            'tanggal' => $this->tanggal,
            'waktu_mulai' => $this->waktu_mulai,
            'waktu_selesai' => $this->waktu_selesai,
            'materi_id' => $this->materiId,
            'code' => Pertemuan::generateCode(
                $this->tanggal,
                $this->waktu_mulai,
                $this->waktu_selesai,
                $this->materiId
            ),
        ]);

        dispatch(new PertemuanCreated($pertemuan));


        $this->closeModalWithEvents([
            PertemuanAbsen::class => ['refresh-list', [
                'message' => 'Pertemuan berhasil ditambahkan',
            ]],
        ]);
    }

    public function render()
    {
        return view('livewire.modal.tambah-pertemuan');
    }
}
