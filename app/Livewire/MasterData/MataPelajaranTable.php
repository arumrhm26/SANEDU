<?php

namespace App\Livewire\MasterData;

use App\Models\Subject;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class MataPelajaranTable extends Component
{

    use WithPagination, WithSearch, WithPerPage;

    public $perPageAs = 'pp-mata-pelajaran';
    public $searchAs = 'search-mata-pelajaran';


    #[On('refresh-list')]
    public function refresh(?string $message = null)
    {
        if ($message) {
            Toaster::success($message); // 👈
        } else {
            Toaster::success('Success');
        }
    }

    public function render()
    {
        return view('livewire.master-data.mata-pelajaran-table', [
            'subjects' => Subject::with(['classRoom', 'teacher.user'])
                ->where('name', 'like', '%' . $this->search . '%')
                ->withCount('materis')
                ->latest()
                ->paginate($this->perPage, ['*'], 'page-mata-pelajaran'),
        ]);
    }
}
