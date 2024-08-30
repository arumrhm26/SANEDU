<?php

namespace App\Livewire\Admin;

use App\Models\ClassRoom;
use App\Models\TahunAjaran;
use App\Traits\WithPerPage;
use App\Traits\WithSearch;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.admin')]
class DetailTahunAjaran extends Component
{
    use WithPagination, WithSearch, WithPerPage;

    public TahunAjaran $tahunAjaran;

    #[On('refresh-list')]
    public function refresh(?string $message = null)
    {
        if ($message) {
            Toaster::success($message); // 👈
        }
    }

    public function render()
    {

        return view(
            'livewire.admin.detail-tahun-ajaran',
            [
                'classRooms' => ClassRoom::with(['tahunAjaran', 'cabang'])
                    ->where('tahun_ajaran_id', $this->tahunAjaran->id)
                    ->whereAny([
                        'full_name',
                    ], 'like', '%' . $this->search . '%')
                    ->withCount('students')
                    ->orderBy('full_name', 'asc')
                    ->paginate($this->perPage),
            ]

        );
    }
}
