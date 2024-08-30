<?php

namespace App\Livewire\Admin\User\Kelas;

use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class SiswaTable extends Component
{
    use WithPagination, WithSearch, WithPerPage;

    public TahunAjaran $tahunAjaran;
    public ClassRoom $classRoom;


    #[On('refresh-list')]
    public function refresh(?string $message = null)
    {
        if ($message) {
            Toaster::success($message); // 👈
        }
    }


    public function deleteStudent(Student $student)
    {

        $this->classRoom->students()->detach($student->id);
        Toaster::success('Data siswa berhasil dihapus'); // 👈
    }

    public function render()
    {
        return view('livewire.admin.user.kelas.siswa-table', [
            'students' => $this->classRoom
                ->students()
                ->with('user')
                ->latest()
                ->where(function ($query) {
                    $query->whereHas('user', function ($query) {
                        $query->where('name', 'like', "%{$this->search}%");
                    });
                })

                ->paginate($this->perPage),

        ]);
    }
}
