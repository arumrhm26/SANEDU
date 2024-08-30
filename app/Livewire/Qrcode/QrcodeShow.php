<?php

namespace App\Livewire\Qrcode;

use App\Models\Pertemuan;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class QrcodeShow extends Component
{

    public Pertemuan $pertemuan;

    public function render()
    {
        return view('livewire.qrcode.qrcode-show');
    }
}
