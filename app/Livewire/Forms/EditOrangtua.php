<?php

namespace App\Livewire\Forms;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditOrangtua extends Form
{
    public ?User $user;

    public ?string $name = '';

    public ?string $email = '';

    public ?string $student_email = '';

    public ?string $hubungan = '';

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user->id)],
            'student_email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'exists:users,email'],
            'hubungan' => ['required', 'string', 'max:255'],
        ];
    }

    public function save()
    {
        $this->validate();

        // validate student email
        $student = User::where('email', $this->student_email)->first();
        if (!$student->hasRole(Role::SISWA)) {
            $this->addError('student_email', 'Email siswa tidak valid');
        }
        unset($student);



        $this->user->update(
            [
                'name' => $this->name,
                'email' => $this->email
            ]
        );

        $this->user->save();

        try {
            if ($this->user->studentParent()->exists()) {
                $this->user->studentParent()->update(
                    [
                        'student_id' => User::where('email', $this->student_email)->first()->id,
                        'hubungan' => $this->hubungan
                    ]
                );
            } else {
                $this->user->studentParent()->create(
                    [
                        'student_id' => User::where('email', $this->student_email)->first()->id,
                        'hubungan' => $this->hubungan
                    ]
                );
            }
        } catch (\Exception $e) {
            $this->addError('email', $e->getMessage());
        }
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        $this->fill($user);
        if ($user->studentParent()->exists()) {
            $this->fill($user->studentParent);
            $this->student_email = $user->studentParent->child->email ?? '';
        }
    }
}
