<?php

namespace App\Livewire\Admin\Absen;

use App\Models\Pertemuan;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class PertemuanAbsen extends Component
{

    use WithPagination, WithPerPage, WithSearch;
    public $tahunAjaranId;

    #[On('refresh-list')]
    public function refresh(?string $message)
    {
        if ($message) {
            Toaster::success($message); // 👈
        }
    }

    public function mount()
    {
        $this->tahunAjaranId = TahunAjaran::query()->where('mulai', '<=', now()->format('Y-m-d'))
            ->where('selesai', '>=', now()->format('Y-m-d'))
            ->first()->id ?? null;
    }


    public function render()
    {
        return view('livewire.admin.absen.pertemuan-absen', [
            'pertemuans' => Pertemuan::with(['materi', 'materi.subject', 'materi.subject.classRoom', 'materi.subject.teacher.user'])
                ->whereHas('materi', function ($query) {
                    $query->where('name', 'like', "%$this->search%");
                    $query->orWhereHas('subject', function ($query) {
                        $query->where('name', 'like', "%$this->search%");
                        $query->orWhereHas('classRoom', function ($query) {
                            $query->where('name', 'like', "%$this->search%");
                        });
                    });
                })
                ->whereHas('materi.subject.classRoom', function ($query) {
                    $query->where('tahun_ajaran_id', $this->tahunAjaranId);
                })
                ->latest()
                ->paginate($this->perPage),
        ]);
    }
}
