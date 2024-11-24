<?php

namespace App\Livewire\Admin\Absen\RekapanAbsen;

use App\Exports\PertemuanExport;
use App\Models\ClassRoom;
use App\Models\Materi;
use App\Models\Pertemuan;
use App\Models\Subject;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithRefreshList;
use App\Traits\WithSearch;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class DetailAbsen extends Component
{

    use WithPagination, WithPerPage, WithSearch;

    public Pertemuan $pertemuan;

    public $status = [];

    public function updatedStatus($value, $index)
    {
        $this->status[$index] = $value;

        $this->validate([
            'status.' . $index => 'required|exists:pertemuan_statuses,id',
        ]);

        $this->pertemuan->pertemuanStudents()->find($index)->update([
            'pertemuan_status_id' => $value,
        ]);

        $this->dispatch('refresh-list');
    }

    #[On('refresh-list')]
    public function refresh()
    {
        $this->pertemuan->refresh();
    }

    #[On('closeModal')]
    public function closeModal()
    {
        $this->refresh();
        $this->status = $this->pertemuan->pertemuanStudents->mapWithKeys(function ($pertemuanStudent) {
            return [$pertemuanStudent->id => $pertemuanStudent->pertemuan_status_id];
        })->toArray();
    }

    public function exportPDF()
    {
        return redirect()->route('rekapan-absen.pdf', $this->pertemuan);
    }

    public function mount(Pertemuan $pertemuan)
    {
        $this->pertemuan = $pertemuan;
        $this->status = $this->pertemuan->pertemuanStudents->mapWithKeys(function ($pertemuanStudent) {
            return [$pertemuanStudent->id => $pertemuanStudent->pertemuan_status_id];
        })->toArray();
    }


    public function render()
    {
        return view('livewire.admin.absen.rekapan-absen.detail-absen', [
            'pertemuanStudents' => $this->pertemuan->pertemuanStudents()
                ->with(['student', 'pertemuanStatus', 'pertemuan.materi.subject', 'pertemuan.materi.subject.classRoom', 'pertemuan.materi.subject.teacher.user'])
                ->orderBy('student_id')
                ->whereHas('student.user', function ($query) {
                    $query->where('name', 'like', "%$this->search%");
                })
                ->latest()
                ->paginate($this->perPage),
            'pertemuan' => $this->pertemuan,
        ]);
    }
}
