<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditGuru extends Form
{
    public ?User $user = null;

    public ?string $name = '';

    public ?string $email = '';

    public ?string $rekening_bank = '';

    public ?string $no_rekening = '';

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user->id)],
            'rekening_bank' => ['required', 'string', 'max:255'],
            'no_rekening' => ['required', 'string', 'max:255'],
        ];
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        $this->fill($user);
        if ($user->teacher()->exists())
            $this->fill($user->teacher);
    }

    public function save()
    {
        $this->validate();

        $this->user->update(
            [
                'name' => $this->name,
                'email' => $this->email
            ]
        );

        try {
            if ($this->user->teacher()->exists()) {
                $this->user->teacher()->update(
                    [
                        'rekening_bank' => $this->rekening_bank,
                        'no_rekening' => $this->no_rekening
                    ]
                );
            } else {
                $this->user->teacher()->create(
                    [
                        'rekening_bank' => $this->rekening_bank,
                        'no_rekening' => $this->no_rekening
                    ]
                );
            }
        } catch (\Throwable $th) {
            dd($th);
            throw $th;
        }
    }
}
