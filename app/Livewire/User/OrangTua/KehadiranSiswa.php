<?php

namespace App\Livewire\User\OrangTua;

use App\Models\PertemuanStudent;
use App\Models\Student;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.user')]
class KehadiranSiswa extends Component
{

    use WithPagination, WithPerPage, WithSearch;
    public $tahunAjarans;
    public $tahunAjaran;

    public $bulans;
    public $bulan;

    public $studentUser;

    public function updatedTahunAjaran()
    {
        $tahunAjaran = TahunAjaran::find($this->tahunAjaran);
        if (!$tahunAjaran) {
            return;
        }

        $this->bulans = $tahunAjaran->getBulan();

        $this->reset('bulan');
    }

    public function exportPDF()
    {
        if (!$this->tahunAjaran) {
            return;
        }

        return redirect()->route('siswa.riwayat-kehadiran.pdf', $this->tahunAjaran);
    }

    public function mount()
    {
        $this->studentUser = Student::where(
            'user_id',
            Auth::user()->studentParent->child->id
        )->first();

        $now = now();
        $this->tahunAjarans = TahunAjaran::all();
        $this->tahunAjaran = TahunAjaran::query()
            ->where('mulai', '<=', $now)
            ->where('selesai', '>=', $now)
            ->first()->id ?? null;

        if ($this->tahunAjaran) {
            $this->bulans = TahunAjaran::find($this->tahunAjaran)->getBulan();
        }
    }

    public function render()
    {
        return view('livewire.user.orang-tua.kehadiran-siswa', [
            'pertemuanStudents' => PertemuanStudent::with(['pertemuan', 'student', 'pertemuanStatus'])

                ->whereHas('student', function ($query) {
                    $query->where('id', $this->studentUser->id);
                })


                ->whereHas('pertemuan', function ($query) {
                    $query->whereHas('materi', function ($query) {
                        $query->whereHas('subject', function ($query) {
                            $query->whereHas('classRoom', function ($query) {
                                $query->where('tahun_ajaran_id', $this->tahunAjaran);
                            });
                        });
                    });
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
