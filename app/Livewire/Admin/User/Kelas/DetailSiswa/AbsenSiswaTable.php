<?php

namespace App\Livewire\Admin\User\Kelas\DetailSiswa;

use App\Models\ClassRoom;
use App\Models\PertemuanStudent;
use App\Models\Student;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class AbsenSiswaTable extends Component
{
    use WithPagination, WithPerPage, WithSearch;

    public $perPageAs = 'pp-absen';
    public $searchAs = 'search-absen';

    public Student $student;

    public ClassRoom $classRoom;

    #[On('refresh-list')]
    public function refresh() {}

    public function render()
    {
        return view('livewire.admin.user.kelas.detail-siswa.absen-siswa-table', [
            'pertemuanStudents' => $this->student
                ->pertemuanStudents()
                ->with(['pertemuan', 'pertemuanStatus'])
                ->whereHas('pertemuan', function ($query) {
                    $query->whereHas('materi', function ($query) {
                        $query->where('name', 'like', "%{$this->search}%");
                        $query->whereHas('subject', function ($query) {
                            $query->where('class_room_id', $this->classRoom->id);
                        });
                    });
                })
                ->latest()
                ->paginate($this->perPage),
        ]);
    }
}
