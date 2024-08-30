<?php

namespace App\Livewire\Admin\User\Kelas\DetailSiswa;

use App\Models\ClassRoom;
use App\Models\Student;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ProgresSiswaTable extends Component
{

    use WithPagination, WithPerPage, WithSearch;

    public Student $student;
    public ClassRoom $classRoom;

    #[On('refresh-list')]
    public function refresh() {}

    public function render()
    {
        return view('livewire.admin.user.kelas.detail-siswa.progres-siswa-table', [
            'studentIndikators' => $this->student
                ->studentIndikators()
                ->with(['indikator', 'indikator.materi', 'indikator.materi.subject'])
                ->whereHas('indikator', function ($query) {
                    $query->where('name', 'like', "%{$this->search}%");
                    $query->orWhereHas('materi', function ($query) {
                        $query->where('name', 'like', "%{$this->search}%");
                        $query->orWhereHas('subject', function ($query) {
                            $query->where('name', 'like', "%{$this->search}%");
                            $query->orWhereHas('classRoom', function ($query) {
                                $query->where('name', 'like', "%{$this->search}%");
                            });
                        });
                    });
                })
                ->withWhereHas('indikator', function ($query) {
                    $query->whereHas('materi', function ($query) {
                        $query->whereHas('subject', function ($query) {
                            $query->whereHas('classRoom', function ($query) {
                                $query->where('id', $this->classRoom->id);
                                $query->where('tahun_ajaran_id', $this->classRoom->tahun_ajaran_id);
                            });
                        });
                    });
                })
                ->latest()
                ->paginate($this->perPage),
        ]);
    }
}
