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
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class DetailAbsen extends Component
{

    use WithPagination, WithPerPage, WithSearch, WithRefreshList;

    public Pertemuan $pertemuan;

    public function exportExcel()
    {
        $tahunAjaranName = TahunAjaran::find($this->pertemuan->materi->subject->classRoom->tahun_ajaran_id)->name;
        // replace "/" in tahun ajaran name
        $tahunAjaranName = str_replace('/', '-', $tahunAjaranName);
        $classRoomName = ClassRoom::find($this->pertemuan->materi->subject->classRoom->id)->full_name;
        $subjectName = Subject::find($this->pertemuan->materi->subject->id)->name;
        $materiName = Materi::find($this->pertemuan->materi->id)->name;

        $fileName = "{$tahunAjaranName}_{$classRoomName}_{$subjectName}_{$materiName}_{$this->pertemuan->tanggal->isoFormat('D-MM-Y')}.xlsx";

        return (new PertemuanExport)->forPertemuanId($this->pertemuan->id)->download($fileName);
    }

    public function exportPDF()
    {
        return redirect()->route('rekapan-absen.pdf', $this->pertemuan);
    }

    public function render()
    {
        return view('livewire.admin.absen.rekapan-absen.detail-absen', [
            'pertemuanStudents' => $this->pertemuan->pertemuanStudents()
                ->with(['student', 'pertemuanStatus', 'pertemuan.materi.subject', 'pertemuan.materi.subject.classRoom', 'pertemuan.materi.subject.teacher.user'])
                ->whereHas('student.user', function ($query) {
                    $query->where('name', 'like', "%$this->search%");
                })
                ->latest()
                ->paginate($this->perPage),
        ]);
    }
}
