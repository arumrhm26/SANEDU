<?php

namespace App\Livewire\Siswa;

use App\Models\PertemuanStudent;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class RiwayatKehadiranTable extends Component
{

    use WithPagination, WithPerPage, WithSearch;

    public $tahunAjaran;

    public function mount()
    {
        $this->tahunAjaran = TahunAjaran::query()->where('mulai', '<=', now()->format('Y-m-d'))
            ->where('selesai', '>=', now()->format('Y-m-d'))
            ->first()->id ?? null;
    }

    public function exportPDF()
    {
        if (!$this->tahunAjaran) {
            return;
        }

        return redirect()->route('siswa.riwayat-kehadiran.pdf', $this->tahunAjaran);
    }

    public function render()
    {
        return view('livewire.siswa.riwayat-kehadiran-table', [
            'pertemuanStudents' => PertemuanStudent::with(['pertemuan', 'student', 'pertemuanStatus'])
                ->whereHas('student.user', function ($query) {
                    $query->where('id', Auth::id());
                })
                ->whereHas('pertemuan.materi.subject.classRoom', function ($query) {
                    $query->where('tahun_ajaran_id', $this->tahunAjaran);
                })
                ->latest()
                ->paginate($this->perPage),
        ]);
    }
}
