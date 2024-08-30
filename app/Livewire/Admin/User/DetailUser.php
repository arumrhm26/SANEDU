<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class DetailUser extends Component
{

    public User $user;

    public function render()
    {
        return view('livewire.admin.user.detail-user');
    }
}
