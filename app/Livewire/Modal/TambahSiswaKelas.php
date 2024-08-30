<?php

namespace App\Livewire\Modal;

use App\Jobs\StudentAddeddToClassRoom;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Traits\WithSearch;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Masmerise\Toaster\Toaster;

class TambahSiswaKelas extends \Livewire\Component
{
    public $search = '';

    public ?ClassRoom $classRoom;

    public $selectedStudents = [];

    public $selectAllToggle = false;
    public function updatedSelectAllToggle()
    {
        $this->selectedStudents = $this->selectAllToggle ? $this->students->pluck('id')->map(fn($id) => (string) $id) : [];
    }

    public function mount()
    {
        $this->classRoom = new ClassRoom();
    }

    #[On('open-modal')]
    public function openModal(ClassRoom $classRoom)
    {
        $this->classRoom = $classRoom;
    }

    #[On('close-modal')]
    public function closeModal()
    {
        $this->classRoom = new ClassRoom();
        $this->selectAllToggle = false;
        $this->selectedStudents = [];

        unset($this->students);
    }

    public function save()
    {

        // dd($this->classRoom->materis->indikators->pluck('id')->toArray());

        // dd($this->selectedStudents);
        $this->validate([
            'selectedStudents' => 'required|array|min:1',
        ]);

        $this->classRoom->classRoomStudents()->createMany(
            collect($this->selectedStudents)->map(function ($studentId) {
                return [
                    'student_id' => $studentId,
                    'tahun_ajaran_id' => $this->classRoom->tahun_ajaran_id,
                    'grade_id' => $this->classRoom->grade_id,
                ];
            })->toArray()
        );

        dispatch(new StudentAddeddToClassRoom($this->classRoom));

        $this->dispatch('close-modal', component: 'tambah-siswa-kelas');
        Toaster::success('Siswa berhasil ditambahkan ke kelas');
        $this->dispatch('refresh-list');
    }



    #[Computed()]
    public function students()
    {
        return Student::with(['user', 'cabang'])
            ->whereHas('user', function ($query) {
                $query->where('name', 'like', "%$this->search%");
            })
            ->whereNotIn('id', $this->classRoom->students->pluck('id'))
            ->where('cabang_id', $this->classRoom->cabang_id)
            ->whereDoesntHave('classRooms', function ($query) {
                $query->where('class_room_students.tahun_ajaran_id', $this->classRoom->tahun_ajaran_id);
            })
            ->get();
    }


    public function render()
    {
        return view('livewire.modal.tambah-siswa-kelas');
    }
}
