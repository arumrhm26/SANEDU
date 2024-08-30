<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;

class EditUserRole extends Component
{

    public User $user;

    public string $role = '';

    public function mount()
    {
        $role = Role::select('id')->where('name', $this->user->getRoleNames()->first())->first();

        $this->role = $role->id;
    }

    public function updateUserRole()
    {
        $this->validate([
            'role' => 'required|exists:roles,id',
        ]);

        $role = Role::findById($this->role);
        $oldRole = Role::where('name', $this->user->getRoleNames()->first())->first();

        $this->user->removeRole($oldRole->name);
        $this->user->assignRole($role->name);
        Toaster::success('User role updated successfully!');

        // refresh page
        return redirect()->route('admin.user.show', $this->user);
    }

    public function render()
    {
        return view('livewire.admin.user.edit-user-role');
    }
}
