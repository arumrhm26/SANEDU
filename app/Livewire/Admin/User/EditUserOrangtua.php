<?php

namespace App\Livewire\Admin\User;

use App\Models\Student;
use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditUserOrangtua extends Component
{

    public User $user;

    public ?string $hubungan = '';
    public ?string $student_id = '';

    public function rules(): array
    {
        return [
            'hubungan' => 'required|string|max:255',
            'student_id' => 'required|numeric|exists:users,id',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        try {

            if ($this->user->studentParent === null) {
                $this->user->studentParent()->create($validated);
                Toaster::success('Profile updated successfully');
                return;
            }

            $this->user->studentParent->fill($validated);
            $this->user->studentParent->save();
            Toaster::success('Profile updated successfully');
        } catch (\Exception $e) {
            Toaster::error('Something went wrong');
        }
    }

    public function mount()
    {
        $this->fill([
            'hubungan' => $this->user->studentParent->hubungan ?? '',
            'student_id' => $this->user->studentParent->student_id ?? '',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.user.edit-user-orangtua', [
            'childs' => Student::with('user')->get()
        ]);
    }
}
