<?php

namespace App\Livewire\Admin\ProgresSiswa;

use App\Models\Indikator;
use App\Models\Materi;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class DetailIndikator extends Component
{

    public Materi $materi;
    public Indikator $indikator;


    public function render()
    {
        return view('livewire.admin.progres-siswa.detail-indikator');
    }
}
