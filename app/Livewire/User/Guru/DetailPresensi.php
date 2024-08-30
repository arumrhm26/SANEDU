<?php

namespace App\Livewire\User\Guru;

use App\Exports\PertemuanExport;
use App\Models\ClassRoom;
use App\Models\Materi;
use App\Models\Pertemuan;
use App\Models\PertemuanStudent;
use App\Models\Subject;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithRefreshList;
use App\Traits\WithSearch;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.user')]
class DetailPresensi extends Component
{
    use WithPagination, WithSearch, WithPerPage, WithRefreshList;
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
        return view('livewire.user.guru.detail-presensi', [
            'pertemuanStudents' => PertemuanStudent::query()
                ->where('pertemuan_id', $this->pertemuan->id)
                ->with('student.user')
                ->paginate($this->perPage),
        ]);
    }
}
