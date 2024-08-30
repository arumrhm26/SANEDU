<?php

namespace App\Livewire\Admin\User;

use App\Enums\Role;
use App\Models\StudentParent;
use App\Models\User;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.admin')]
class OrangtuaTable extends Component
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
    public function users()
    {
        return User::with(['studentParent.child', 'roles'])
            ->role(Role::ORANGTUA)
            ->whereAny([
                'name',
                'email',
            ], 'like', '%' . $this->search . '%')
            ->orwhereHas('studentParent', function ($query) {
                $query->whereHas('child', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view(
            'livewire.admin.user.orangtua-table'
        );
    }
}
