<?php

namespace App\Livewire\Admin\ProgresSiswa;

use App\Models\ClassRoom;
use App\Models\Materi;
use App\Models\Subject;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithRefreshList;
use App\Traits\WithSearch;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;


#[Layout('layouts.admin')]
class KelolaProgresSiswa extends Component
{
    use WithPagination, WithSearch, WithPerPage, WithRefreshList;

    public $tahunAjaran;
    public function updatedTahunAjaran()
    {
        $this->reset('grade', 'classRoom', 'subject');
    }

    public $grade;
    public function updatedGrade()
    {
        $this->classRooms = ClassRoom::query()
            ->where('grade_id', $this->grade)
            ->where('tahun_ajaran_id', $this->tahunAjaran)
            ->get();
        $this->reset('classRoom', 'subject');
    }
    public $classRoom;
    public $classRooms = [];

    public function updatedClassRoom()
    {
        $this->subjects = Subject::query()
            ->where('class_room_id', $this->classRoom)
            ->get();
        $this->reset('subject');
    }
    public $subject;
    public $subjects = [];

    public function render()
    {
        return view('livewire.admin.progres-siswa.kelola-progres-siswa', [
            'materis' => Materi::with(['subject'])
                ->where('name', 'like', "%$this->search%")
                ->where('subject_id', $this->subject)
                ->latest()
                ->withCount('indikators')
                ->paginate($this->perPage, ['*'], 'page-materi'),

        ]);
    }
}
