<?php

namespace App\Livewire\User\Siswa;

use App\Models\StudentIndikator;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChartSiswa extends Component
{

    protected $months;
    protected $nilais;

    public $chart;

    public function mount()
    {
        $currentTahunAjaran = TahunAjaran::query()->where('mulai', '<=', now()->format('Y-m-d'))
            ->where('selesai', '>=', now()->format('Y-m-d'))
            ->first() ?? null;

        if (!$currentTahunAjaran) {
            $this->months = [];
            return;
        }

        $mulai = $currentTahunAjaran->mulai;
        $selesai = $currentTahunAjaran->selesai;

        $this->months = $this->getMonths($mulai, $selesai);

        // get all nilai from student indikator where user id is auth user id and updated at is in months array but created at and updated at is not same
        $this->nilais = StudentIndikator::query()
            ->whereHas('indikator.materi.subject.classRoom', function ($query) use ($currentTahunAjaran) {
                $query->where('tahun_ajaran_id', $currentTahunAjaran->id);
            })
            ->where('student_id', Auth::user()->student->id)
            ->whereColumn('updated_at', '>', 'created_at')
            ->get()
            ->groupBy(function ($item) {
                return $item->updated_at->format('Y-m');
            })
            ->map(function ($item) {
                return $item->avg('nilai');
            });

        $this->chart = $this->getChart();
    }

    protected function getMonths($mulai, $selesai)
    {
        $months = [];
        $mulai = new \DateTime($mulai);
        $selesai = new \DateTime($selesai);

        while ($mulai <= $selesai) {
            $months[] = $mulai->format('Y-m');
            $mulai->modify('+1 month');
        }

        return $months;
    }

    protected function getChart()
    {
        $collection = collect($this->months);
        $chart = [
            'labels' => $this->months,
            'datas' => $collection->map(function ($month) {
                return $this->nilais[$month] ?? 0;
            })
        ];

        return $chart;
    }



    public function render()
    {
        return view('livewire.user.siswa.chart-siswa');
    }
}
