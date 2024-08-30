<?php

namespace App\Livewire\Forms;

use App\Models\ClassRoom;
use App\Models\Grade;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TambahKelas extends Form
{
    public string $name;

    public string $limit_siswa;

    public string $grade_id;

    public string $cabang_id;

    public string $tahun_ajaran_id;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'limit_siswa' => ['required', 'numeric'],
            'grade_id' => ['required', 'numeric', 'exists:grades,id'],
            'cabang_id' => ['required', 'numeric', 'exists:cabangs,id'],
        ];
    }

    public function save()
    {
        $this->validate();

        ClassRoom::create(
            [
                'name' => $this->name,
                'limit_siswa' => $this->limit_siswa,
                'tahun_ajaran_id' => $this->tahun_ajaran_id,
                'grade_id' => $this->grade_id,
                'cabang_id' => $this->cabang_id,
                // 'full_name' => Grade::find($this->grade_id)->name . ' ' . $this->name,
            ]
        );
    }
}
