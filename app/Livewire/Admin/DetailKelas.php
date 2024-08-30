<?php

namespace App\Livewire\Admin;

use App\Models\ClassRoom;
use App\Models\TahunAjaran;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('layouts.admin')]
class DetailKelas extends Component
{

    public ClassRoom $classRoom;
    public TahunAjaran $tahunAjaran;

    #[Url(history: false)]
    public $activeTab = 'siswa';

    public function changeTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.admin.user.kelas.detail-kelas');
    }
}
