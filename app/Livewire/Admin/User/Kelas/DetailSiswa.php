<?php

namespace App\Livewire\Admin\User\Kelas;

use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class DetailSiswa extends Component
{
    use WithPagination, WithSearch, WithPerPage;

    public TahunAjaran $tahunAjaran;
    public ClassRoom $classRoom;
    public Student $student;

    public function mount(Student $student)
    {

        if (
            $student->classRoomStudents()->where('class_room_id', $this->classRoom->id)->doesntExist()
        ) {
            abort(404);
        }

        $this->student = $student;
    }


    public function render()
    {
        return view('livewire.admin.user.kelas.detail-siswa');
    }
}
