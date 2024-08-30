<?php

namespace App\Livewire\Admin\User;

use App\Enums\Role;
use App\Models\User;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class SiswaTable extends Component
{
    use WithPagination, WithSearch, WithPerPage;

    #[Computed()]
    public function users()
    {
        return User::with(['student.classRooms', 'roles'])
            ->role(Role::SISWA)
            ->whereAny([
                'name',
                'email',
            ], 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate($this->perPage);
    }
}
