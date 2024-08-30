<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('layouts.admin')]
class Absensi extends Component
{

    public function render()
    {
        return view('livewire.admin.absensi');
    }
}
