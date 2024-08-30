<?php

namespace App\Livewire\Forms;

use App\Models\Materi;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TambahMateri extends Form
{
    public string $name;

    public string $subject_id;
    public $subjects = [];

    public function rules()
    {
        return [
            'name' => 'required|string',
            'subject_id' => 'required|exists:subjects,id',
        ];
    }

    public function save()
    {
        $this->validate();

        Materi::create([
            'name' => $this->name,
            'subject_id' => $this->subject_id,
        ]);
    }
}
