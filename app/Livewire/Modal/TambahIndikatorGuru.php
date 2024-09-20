<?php

namespace App\Livewire\Modal;

use App\Jobs\IndikatorAddeddToClassRoom;
use App\Models\Subject;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class TambahIndikatorGuru extends ModalComponent
{
    public $tahunAjarans;
    public $tahunAjaranId;

    public $subjects;
    public $subjectId;

    public $materis = [];
    public $materiId;

    public $indikatorName;

    public function updatedTahunAjaranId()
    {
        $this->subjects = Subject::query()
            ->whereHas('classRoom', function ($query) {
                $query->where('tahun_ajaran_id', $this->tahunAjaranId);
            })
            ->whereHas('teacher', function ($query) {
                $query->where('id', Auth::user()->teacher->id);
            })
            ->get();

        $this->reset('subjectId', 'materiId', 'indikatorName');
    }

    public function updatedSubjectId($value)
    {
        $this->reset('materiId', 'indikatorName');
        $this->subjectId = $value;
        if ($value) {
            $this->materis = Subject::find($value)->materis;
        }
    }

    public function save()
    {
        $this->validate([
            'tahunAjaranId' => 'required',
            'subjectId' => 'required',
            'materiId' => 'required',
            'indikatorName' => 'required',
        ]);

        $materi = Subject::find($this->subjectId)->materis()->find($this->materiId);

        $classRoom = $materi->subject->classRoom;

        $createdIndikator = $materi->indikators()->create([
            'name' => $this->indikatorName,
        ]);

        $this->closeModal();
        $this->dispatch('refresh-list');
        dispatch(new IndikatorAddeddToClassRoom($classRoom, $createdIndikator));
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
            $this->subjects = Subject::query()
                ->whereHas('classRoom', function ($query) {
                    $query->where('tahun_ajaran_id', $this->tahunAjaranId);
                })
                ->whereHas('teacher', function ($query) {
                    $query->where('id', Auth::user()->teacher->id);
                })
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.modal.tambah-indikator-guru');
    }
}
