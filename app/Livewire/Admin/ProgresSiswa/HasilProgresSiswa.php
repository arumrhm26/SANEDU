<?php

namespace App\Livewire\Admin\ProgresSiswa;

use App\Models\ClassRoom;
use App\Models\ClassRoomStudent;
use App\Models\StudentIndikator;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class HasilProgresSiswa extends Component
{
    use WithPagination, WithSearch, WithPerPage;



    public $tahunAjaran;

    public function updatedTahunAjaran()
    {
        $this->reset('classRoom', 'grade');
    }

    public $grade;
    public function updatedGrade()
    {
        $this->classRooms = ClassRoom::query()
            ->where('grade_id', $this->grade)
            ->where('tahun_ajaran_id', $this->tahunAjaran)
            ->get();
        $this->reset('classRoom');
    }

    public $classRoom;
    public $classRooms = [];

    public function mount()
    {
        $this->perPage = 100;
    }

    public function render()
    {
        return view('livewire.admin.progres-siswa.hasil-progres-siswa', [
            'studentIndikators' => StudentIndikator::query()
                ->with(['student', 'indikator', 'indikator.materi.subject.classRoom'])
                ->whereHas('indikator.materi.subject.classRoom', function ($query) {
                    $query->where('id', $this->classRoom);
                })
                ->whereHas('student.user', function ($query) {
                    $query->where('name', 'like', "%$this->search%");
                })
                ->orderBy('indikator_id')
                ->paginate($this->perPage),

        ]);
    }
}
