<?php

namespace App\Livewire\Forms;

use App\Jobs\IndikatorAddeddToClassRoom;
use App\Models\Indikator;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TambahIndikator extends Form
{
    public string $name;

    public string $materi_id;

    public function rules()
    {

        return [
            'name' => 'required|string',
            'materi_id' => 'required|exists:materis,id',
        ];
    }

    public function save()
    {
        $this->validate();

        $createdIndikator = Indikator::create([
            'name' => $this->name,
            'materi_id' => $this->materi_id,
        ]);

        $classRoom = $createdIndikator->materi->subject->classRoom;

        dispatch(new IndikatorAddeddToClassRoom($classRoom, $createdIndikator));
    }
}
