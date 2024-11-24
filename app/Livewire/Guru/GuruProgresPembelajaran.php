<?php

namespace App\Livewire\Guru;

use App\Exports\PertemuanExport;
use App\Exports\ProgresSiswaExport;
use App\Exports\ProgresSiswaExportGuru;
use App\Models\ClassRoom;
use App\Models\Materi;
use App\Models\Student;
use App\Models\StudentIndikator;
use App\Models\Subject;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithRefreshList;
use App\Traits\WithSearch;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

#[Layout('layouts.user')]
class GuruProgresPembelajaran extends Component
{

    use WithPagination, WithRefreshList, WithPerPage, WithSearch;

    #[Url(keep: true)]
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
        $this->reset('subject', 'classRoomId', 'materiId');
    }

    #[Url(keep: true)]
    public $classRoomId;

    #[Url(keep: true)]
    public $subject;
    public $subjects = [];

    public function updatedSubject($value)
    {
        $this->reset('classRoomId', 'materiId');
        $this->subject = $value;
        if ($value) {
            $this->materis = Subject::find($value)->materis;
        }
    }

    #[Url(keep: true)]
    public $materiId = null;
    public $materis = [];
    public $indikators = [];

    public function updatedMateriId($value)
    {
        $this->materiId = $value;
        $this->classRoomId = Materi::find($value)->subject->classRoom->id;
        $this->indikators = Materi::find($value)->indikators;
    }

    public function getNilai($studentId, $indikatorId)
    {
        return StudentIndikator::query()
            ->where('student_id', $studentId)
            ->where('indikator_id', $indikatorId)
            ->first()->nilai ?? 0;
    }

    #[On('updated-nilai')]
    public function updatedNilai($studentId, $indikatorId)
    {
        $this->getNilai($studentId, $indikatorId);
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

            if ($this->subject) {
                $this->materis = Subject::find($this->subject)->materis;
            }

            if ($this->materiId && $this->subject) {
                $this->indikators = Materi::find($this->materiId)->indikators;
            }
        }
    }

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
