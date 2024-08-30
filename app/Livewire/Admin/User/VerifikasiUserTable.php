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
class VerifikasiUserTable extends Component
{
    use WithPagination, WithSearch, WithPerPage;


    #[On('refresh-list')]
    public function refresh(?string $message)
    {
        if ($message) {
            Toaster::success($message); // 👈
        }
    }

    #[Computed()]
    public function users()
    {
        return User::where('email_verified_at', null)
            ->whereAny([
                'name',
                'email',
            ], 'like', '%' . $this->search . '%')
            ->with('studentParent.child')
            ->latest()
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.user.verifikasi-user-table');
    }
}
