<?php

namespace App\Livewire\Admin\User\Kelas;

use App\Models\ClassRoom;
use App\Models\Indikator;
use App\Models\Pertemuan;
use App\Models\PertemuanStudent;
use App\Models\StudentIndikator;
use App\Models\Subject;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

#[Lazy]
class MataPelajaranTable extends Component
{
    use WithPagination, WithPerPage, WithSearch;


    public TahunAjaran $tahunAjaran;
    public ClassRoom $classRoom;

    #[On('refresh-list')]
    public function refresh(?string $message = null)
    {
        if ($message)
            Toaster::success($message);
    }

    public function deleteSubject(Subject $subject)
    {

        // get all materis from subject 
        $materis = $subject->materis->pluck('id')->toArray();

        // get all indikators from materis
        $indikators = Indikator::whereIn('materi_id', $materis)->pluck('id')->toArray();

        // delete all student indikators
        StudentIndikator::whereIn('indikator_id', $indikators)->delete();

        // delete all pertemuan with materi
        $pertemuanIds = Pertemuan::whereIn('materi_id', $materis)->pluck('id')->toArray();
        PertemuanStudent::whereIn('pertemuan_id', $pertemuanIds)
            ->delete();
        Pertemuan::whereIn('materi_id', $materis)->delete();

        // delete all indikators
        Indikator::whereIn('id', $indikators)->delete();

        // delete all materis
        $subject->materis()->delete();

        // delete subject
        $subject->delete();
        Toaster::success('Data mata pelajaran berhasil dihapus');
    }


    public function placeholder()
    {
        return view('livewire.placeholders.table-loading');
    }

    public function render()
    {
        return view('livewire.admin.user.kelas.mata-pelajaran-table', [
            'subjects' => Subject::with(['classRoom', 'teacher.user'])
                ->where('class_room_id', $this->classRoom->id)
                ->where('name', 'like', '%' . $this->search . '%')
                ->withCount('materis')
                ->latest()
                ->paginate($this->perPage),
        ]);
    }
}
