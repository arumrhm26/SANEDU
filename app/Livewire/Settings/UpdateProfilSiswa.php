<?php

namespace App\Livewire\Settings;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class UpdateProfilSiswa extends Component
{

    public $asal_sekolah;

    public $cabang_id;

    public function updateProfilSiswa(): void
    {
        $validated = $this->validate([
            'asal_sekolah' => ['required', 'string'],
            'cabang_id' => ['required', 'integer'],
        ]);

        Auth::user()->student->update([
            'asal_sekolah' => $validated['asal_sekolah'],
            'cabang_id' => $validated['cabang_id'],
        ]);


        Toaster::success('Profil siswa berhasil diperbarui');
    }

    public function mount()
    {
        $this->asal_sekolah = Auth::user()->student->asal_sekolah;
        $this->cabang_id = Auth::user()->student->cabang_id;
    }

    public function render()
    {
        return view('livewire.settings.update-profil-siswa');
    }
}
