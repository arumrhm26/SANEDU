<?php

namespace App\Livewire\Modal;

use App\Models\Subject;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class TambahMateriGuru extends ModalComponent
{

    public $tahunAjarans;
    public $tahunAjaranId;

    public $subjects;
    public $subjectId;

    public $materiName;

    public function save()
    {
        $this->validate([
            'tahunAjaranId' => 'required',
            'subjectId' => 'required',
            'materiName' => 'required',
        ]);

        $subject = Subject::find($this->subjectId);

        $subject->materis()->create([
            'name' => $this->materiName,
        ]);

        $this->closeModal();
        $this->dispatch('refresh-list');
    }


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
        return view('livewire.modal.tambah-materi-guru');
    }
}
