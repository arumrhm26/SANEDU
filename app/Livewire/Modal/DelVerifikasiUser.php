<?php

namespace App\Livewire\Modal;

use App\Livewire\Admin\User\VerifikasiUserTable;
use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DelVerifikasiUser extends ModalComponent
{
    public ?User $user = null;

    public function reject()
    {
        // $user = User::find($this->user->id);
        $this->user->delete();
        $this->user = null;
        $this->closeModalWithEvents([
            VerifikasiUserTable::class => ['refresh-list', [
                'message' => 'User berhasil di hapus',
            ]],
        ]);
        // $this->closeModal();
        // $this->dispatch('refresh-list', ['message' => 'User berhasil dihapus']);
        // $this->js('window.location.reload()');
        // $this->redirect(route('admin.verifikasi-akun'));
    }

    public function render()
    {
        return view('livewire.modal.del-verifikasi-user');
    }
}
