<?php

namespace App\Livewire\Admin\Absen;

use App\Models\Pertemuan;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class RekapanAbsen extends Component
{

    use WithPerPage, WithSearch, WithPagination;

    public $tahunAjarans;
    public $tahunAjaranId;

    public function updatedTahunAjaranId()
    {
        $this->bulans = $this->getBulanFromTahunAjaran($this->tahunAjaranId);
    }

    public $bulans;
    public $bulan;

    public function updatedBulan()
    {
        // dd($this->bulan);
    }

    public function getBulanFromTahunAjaran($tahunAjaranId)
    {
        $tahunAjaran = TahunAjaran::find($tahunAjaranId);

        if (!$tahunAjaran) {
            return [];
        }

        return $tahunAjaran->getBulan();
    }

    public function exportPDF()
    {
        if (!$this->tahunAjaranId || !$this->bulan) {
            return;
        }

        return redirect()->route('rekapan-absen-perbulan.pdf', [
            'tahunAjaran' => $this->tahunAjaranId,
            'bulan' => $this->bulan,
        ]);
    }

    public function mount()
    {
        $this->tahunAjarans = TahunAjaran::all();

        $now = now();

        $this->tahunAjaranId = TahunAjaran::query()
            ->where('mulai', '<=', $now)
            ->where('selesai', '>=', $now)
            ->first()->id ?? null;

        if ($this->tahunAjaranId) {
            $this->bulans = $this->getBulanFromTahunAjaran($this->tahunAjaranId);
            $this->bulan = $this->bulans[0]->id ?? null;
        }
    }


    public function render()
    {
        return view('livewire.admin.absen.rekapan-absen', [
            'pertemuans' => Pertemuan::query()
                ->with(['materi', 'materi.subject', 'materi.subject.classRoom', 'materi.subject.teacher.user'])
                ->whereHas('materi', function ($query) {
                    $query->where('name', 'like', "%$this->search%");
                    $query->orWhereHas('subject', function ($query) {
                        $query->where('name', 'like', "%$this->search%");
                        $query->orWhereHas('classRoom', function ($query) {
                            $query->where('name', 'like', "%$this->search%");
                        });
                    });
                })
                ->when($this->bulan != null, function ($query) {
                    $query->whereMonth('tanggal', $this->bulan);
                    $query->whereHas('materi.subject.classRoom.tahunAjaran', function ($query) {
                        $query->where('id', $this->tahunAjaranId);
                    });
                })
                ->latest()
                ->paginate($this->perPage),
        ]);
    }
}
