<?php

namespace App\Livewire\Guru;

use App\Exports\PertemuanExport;
use App\Exports\ProgresSiswaExport;
use App\Exports\ProgresSiswaExportGuru;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\Subject;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithRefreshList;
use App\Traits\WithSearch;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

#[Layout('layouts.user')]
class GuruProgresPembelajaran extends Component
{

    use WithPagination, WithRefreshList, WithPerPage, WithSearch;

    public $tahunAjaran;

    public function updatedTahunAjaran()
    {
        $this->subjects = Subject::query()
            ->whereHas('classRoom', function ($query) {
                $query->where('tahun_ajaran_id', $this->tahunAjaran);
            })
            ->whereHas('teacher', function ($query) {
                $query->where('id', Auth::user()->teacher->id);
            })
            ->get();
        $this->reset('subject', 'classRoomId');
    }

    public $classRoomId;
    public $subject;
    public $subjects = [];

    public function updatedSubject($value)
    {
        $this->reset('classRoomId');
        $this->subject = $value;
        if ($value) {
            $this->classRoomId = Subject::find($value)->class_room_id;
        }
    }


    public function exportExcel()
    {

        if (!$this->subject) {
            return;
        }

        $materis = Subject::find($this->subject)->materis;

        $tahunAjaranName = TahunAjaran::find($this->tahunAjaran)->name;
        $tahunAjaranName = str_replace('/', '-', $tahunAjaranName);

        $classRoomName = Subject::find($this->subject)?->classRoom->full_name;
        $subjectName = Subject::find($this->subject)->name;


        foreach ($materis as $materi) {
            Excel::store(new ProgresSiswaExportGuru($materi->id), "{$tahunAjaranName}_{$classRoomName}_{$subjectName}_{$materi->name}.xlsx");
        }

        $zip = new \ZipArchive();
        $zipFileName = "{$tahunAjaranName}_{$classRoomName}_{$subjectName}.zip";

        if ($zip->open(storage_path("app/{$zipFileName}"), \ZipArchive::CREATE) === TRUE) {
            foreach ($materis as $materi) {
                $zip->addFile(storage_path("app/{$tahunAjaranName}_{$classRoomName}_{$subjectName}_{$materi->name}.xlsx"), "{$materi->name}.xlsx");
            }
            $zip->close();

            foreach ($materis as $materi) {
                unlink(storage_path("app/{$tahunAjaranName}_{$classRoomName}_{$subjectName}_{$materi->name}.xlsx"));
            }
        }

        return response()->download(storage_path("app/{$zipFileName}"))->deleteFileAfterSend(true);
    }

    public function exportPDF()
    {

        if (!$this->subject) {
            return;
        }

        return redirect()->route('rekapan-progres-guru.pdf', ['subject' => $this->subject]);
    }




    public function mount()
    {
        $now = now();

        $this->tahunAjaran = TahunAjaran::query()
            ->where('mulai', '<=', $now->format('Y-m-d'))
            ->where('selesai', '>=', $now->format('Y-m-d'))
            ->first()->id ?? null;

        if ($this->tahunAjaran) {
            $this->subjects = Subject::query()
                ->whereHas('classRoom', function ($query) {
                    $query->where('tahun_ajaran_id', $this->tahunAjaran);
                })
                ->whereHas('teacher', function ($query) {
                    $query->where('id', Auth::user()->teacher->id);
                })
                ->get();
        }
    }

    #[Computed]
    public function students()
    {
        return $this->classRoomId ? Student::query()
            ->whereHas('classRooms', function ($query) {
                $query->where('class_room_id', $this->classRoomId);
            })
            ->paginate(
                $this->perPage,
                ['*'],
                'students'
            ) : [];
    }

    public function render()
    {
        return view('livewire.guru.guru-progres-pembelajaran');
    }
}
