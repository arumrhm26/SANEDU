<?php

namespace App\Livewire\MasterData;

use App\Models\Indikator;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class IndikatorTable extends Component
{

    use WithPagination;

    #[Url(except: 10, as: 'pp-indikator')]
    public $perPage = 10;
    public function updatedPerPage()
    {
        $this->resetPage();
    }

    #[Url(except: '', as: 'search-indikator')]
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
        return view('livewire.master-data.indikator-table', [
            'indikators' => Indikator::with(['materi.subject.classRoom'])
                ->where('name', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate($this->perPage, ['*'], 'page-indikator'),
        ]);
    }
}
