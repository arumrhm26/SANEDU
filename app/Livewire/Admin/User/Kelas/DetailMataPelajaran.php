<?php

namespace App\Livewire\Admin\User\Kelas;

use App\Models\ClassRoom;
use App\Models\Subject;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class DetailMataPelajaran extends Component
{

    use WithPagination, WithSearch, WithPerPage;

    public TahunAjaran $tahunAjaran;

    public ClassRoom $classRoom;

    public Subject $subject;

    #[On('refresh-list')]
    public function refresh() {}

    public function mount(Subject $subject)
    {
        // check if subject is not in class room
        if (
            $subject->class_room_id !== $this->classRoom->id
        ) {
            abort(404);
        }

        $this->subject = $subject;
    }

    public function render()
    {
        return view('livewire.admin.user.kelas.detail-mata-pelajaran', [
            'materis' => $this->subject->materis()->paginate($this->perPage)
        ]);
    }
}
