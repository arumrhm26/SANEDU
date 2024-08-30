<?php

namespace App\Livewire\User\Guru;

use App\Jobs\PertemuanCreated;
use App\Models\ClassRoom;
use App\Models\Materi;
use App\Models\Pertemuan;
use App\Models\Subject;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithRefreshList;
use App\Traits\WithSearch;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.user')]
class Presensi extends Component
{
    use WithPagination, WithPerPage, WithSearch, WithRefreshList;
    public $tahunAjaranId;

    public function updatedTahunAjaranId()
    {
        $this->classRooms = ClassRoom::query()
            ->where('tahun_ajaran_id', $this->tahunAjaranId)
            ->get();

        $this->reset('classRoomId', 'subject', 'materi');
    }

    public $classRoomId;
    public $classRooms = [];

    public function updatedClassRoomId()
    {
        $this->subjects = Subject::query()
            ->where('class_room_id', $this->classRoomId)
            ->whereHas('teacher', function ($query) {
                $query->where('id', Auth::user()->teacher->id);
            })
            ->get();

        $this->reset('subject', 'materi');
    }

    public $subject;
    public $subjects = [];

    public function updatedSubject()
    {
        $this->materis = Materi::query()
            ->where('subject_id', $this->subject)
            ->get();
        $this->reset('materi');
    }

    public $materi;
    public $materis = [];


    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset('classRoomId', 'subject', 'materi');
    }

    public $tanggal;
    public $waktu_mulai;
    public $waktu_selesai;

    public function rules()
    {
        return [
            'materi' => 'required|exists:materis,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ];
    }

    public function create()
    {
        $this->validate();

        $pertemuan = Pertemuan::create([
            'tanggal' => $this->tanggal,
            'waktu_mulai' => $this->waktu_mulai,
            'waktu_selesai' => $this->waktu_selesai,
            'materi_id' => $this->materi,
            'code' => Pertemuan::generateCode(
                $this->tanggal,
                $this->waktu_mulai,
                $this->waktu_selesai,
                $this->materi
            ),
        ]);

        dispatch(new PertemuanCreated($pertemuan));

        $this->reset('tanggal', 'waktu_mulai', 'waktu_selesai', 'materi', 'subject', 'classRoomId',);

        $this->dispatch('close-modal', component: 'guru-tambah-pertemuan');
        Toaster::success('Pertemuan berhasil ditambahkan');
        $this->dispatch('refresh-list');
    }



    public function mount()
    {

        $now = now();

        $this->tahunAjaranId = TahunAjaran::query()
            ->where('mulai', '<=', $now->format('Y-m-d'))
            ->where('selesai', '>=', $now->format('Y-m-d'))
            ->first()->id ?? null;

        if ($this->tahunAjaranId) {
            $this->classRooms = ClassRoom::query()
                ->where('tahun_ajaran_id', $this->tahunAjaranId)
                ->get();
        }
    }

    public function render()
    {
        return view(
            'livewire.user.guru.presensi',
            [
                'pertemuans' => Pertemuan::query()
                    ->with(['materi', 'materi.subject', 'materi.subject.classRoom', 'materi.subject.teacher.user'])

                    ->whereHas('materi.subject.teacher', function ($query) {
                        $query->where('user_id', Auth::id());
                    })

                    ->whereHas('materi', function ($query) {
                        $query->where('name', 'like', "%$this->search%");
                        $query->orWhereHas('subject', function ($query) {
                            $query->where('name', 'like', "%$this->search%");
                            $query->orWhereHas('classRoom', function ($query) {
                                $query->where('name', 'like', "%$this->search%");
                            });
                        });
                    })

                    ->whereHas('materi.subject.classRoom', function ($query) {
                        $query->where('tahun_ajaran_id', $this->tahunAjaranId);
                    })


                    ->latest()
                    ->paginate($this->perPage),

            ]
        );
    }
}
