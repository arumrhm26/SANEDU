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

    public $tahunAjaran;

    public $studentUser;

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
        $this->tahunAjaran = TahunAjaran::where('mulai', '<=', $now)->where('selesai', '>=', $now)->first()->id;
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
                ->latest()
                ->paginate($this->perPage),
        ]);
    }
}
