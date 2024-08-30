<?php

namespace App\Livewire\Admin\User;

use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;


#[Layout('layouts.admin')]
class TahunAjaranTable extends Component
{

    use WithPagination, WithSearch, WithPerPage;

    #[On('refresh-list')]
    public function refresh(?String $message)
    {
        if ($message) {
            Toaster::success($message); // 👈
        }
    }

    #[Computed]
    public function tahunAjarans()
    {
        return TahunAjaran::latest()
            ->whereAny([
                'name',
            ], 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.user.tahun-ajaran-table',);
    }
}
