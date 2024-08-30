<?php

namespace App\Livewire\MasterData;

use App\Models\Materi;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class MateriTable extends Component
{
    use WithPagination;

    #[Url(except: 10, as: 'pp-materi')]
    public $perPage = 10;
    public function updatedPerPage()
    {
        $this->resetPage();
    }

    #[Url(except: '', as: 'search-materi')]
    public $search = '';
    public function updatedSearch()
    {
        $this->resetPage();
    }

    #[On('refresh-list')]
    public function refresh(?string $message = null)
    {
        if ($message)
            Toaster::success($message); // 👈

    }

    public function render()
    {
        return view('livewire.master-data.materi-table', [
            'materis' => Materi::with(['subject.classRoom'])
                ->where('name', 'like', '%' . $this->search . '%')
                ->latest()
                ->withCount('indikators')
                ->paginate($this->perPage, ['*'], 'page-materi'),
        ]);
    }
}
