<?php

namespace App\Livewire\Modal;

use App\Livewire\Admin\User\VerifikasiUserTable;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class AccVerifikasiUser extends ModalComponent
{
    public ?User $user = null;

    public function approve()
    {

        // if ($this->user()->markEmailAsVerified()) {
        //     event(new Verified($this->user()));
        // }

        // $this->user->update([
        //     'email_verified_at' => now(),
        // ]);

        if ($this->user->markEmailAsVerified()) {
            event(new Verified($this->user));
        }

        $this->closeModalWithEvents([
            VerifikasiUserTable::class => ['refresh-list', [
                'message' => 'User berhasil di verifikasi',
            ]],
        ]);
    }



    public function render()
    {
        return view('livewire.modal.acc-verifikasi-user');
    }
}
