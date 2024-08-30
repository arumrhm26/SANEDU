<?php

namespace App\Livewire\Admin;

use App\Models\Indikator;
use App\Models\Materi;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.admin')]
class DetailMateri extends Component
{
    use WithPagination, WithSearch, WithPerPage;

    public Materi $materi;


    #[On('refresh-list')]
    public function refresh(?string $message = null)
    {
        if ($message)
            Toaster::success($message); // 👈

    }



    public function render()
    {
        return view('livewire.admin.detail-materi', [
            'indikators' => Indikator::where('materi_id', $this->materi->id)
                ->where('name', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate($this->perPage, ['*'], 'page-indikator'),
        ]);
    }
}
