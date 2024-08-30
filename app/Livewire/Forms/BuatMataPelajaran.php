<?php

namespace App\Livewire\Forms;

use App\Models\Subject;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BuatMataPelajaran extends Form
{

    public string $name;

    public string $teacher_id;

    public string $class_room_id;

    public function rules()
    {
        return [
            'name' => 'required|string',
            'teacher_id' => 'required|exists:teachers,id',
            'class_room_id' => 'required|exists:class_rooms,id',
        ];
    }

    public function save()
    {
        $this->validate();

        Subject::create([
            'name' => $this->name,
            'teacher_id' => $this->teacher_id,
            'class_room_id' => $this->class_room_id,
        ]);
    }
}
