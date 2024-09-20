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

    public $tahunAjarans;
    public $tahunAjaran;

    public $bulans;
    public $bulan;

    public function updatedTahunAjaran()
    {
        $this->bulans = $this->getBulanFromTahunAjaran($this->tahunAjaran);

        $this->reset('bulan');
    }

    public function getBulanFromTahunAjaran($tahunAjaranId)
    {
        $tahunAjaran = TahunAjaran::find($tahunAjaranId);

        if (!$tahunAjaran) {
            return [];
        }

        return $tahunAjaran->getBulan();
    }

    public function mount()
    {
        $this->tahunAjarans = TahunAjaran::all();
        $this->tahunAjaran = TahunAjaran::query()->where('mulai', '<=', now()->format('Y-m-d'))
            ->where('selesai', '>=', now()->format('Y-m-d'))
            ->first()->id ?? null;

        if ($this->tahunAjaran) {
            $this->bulans = $this->getBulanFromTahunAjaran($this->tahunAjaran);
        }
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
                ->when($this->bulan, function ($query) {
                    $query->whereHas('pertemuan', function ($query) {
                        $query->whereMonth('tanggal', $this->bulan);
                    });
                })
                ->latest()
                ->paginate($this->perPage),
        ]);
    }
}
