<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;


#[Layout('layouts.admin')]
class GuruTable extends Component
{
    use WithPagination, WithSearch, WithPerPage;


    #[On('refresh-list')]
    public function refresh(?String $message)
    {
        if ($message) {
            Toaster::success($message); // 👈
        }
    }

    #[Computed()]
    public function users()
    {
        return User::with(['teacher'])
            ->role('guru')
            ->whereAny([
                'name',
                'email',
            ], 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate($this->perPage);
    }

    public function reject($id)
    {
        $user = User::find($id);
        $user->delete();
    }

    public function render()
    {
        return view('livewire.admin.user.guru-table');
    }
}
