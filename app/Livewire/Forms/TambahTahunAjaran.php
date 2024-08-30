<?php

namespace App\Livewire\Forms;

use App\Jobs\ImportTahunAjaran;
use App\Models\TahunAjaran;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TambahTahunAjaran extends Form
{
    public string $name;

    public string $mulai;

    public string $selesai;

    public bool $importData = false;

    public $importOptions = [];

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:tahun_ajarans,name'],
            'mulai' => ['required', 'date', 'unique:tahun_ajarans,mulai'],
            'selesai' => ['required', 'date', 'after:mulai', 'unique:tahun_ajarans,selesai'],
        ];
    }

    public function save()
    {
        $this->validate();

        // check id mulai is older than latest selesai
        $latestTahunAjaran = TahunAjaran::orderBy('selesai', 'desc')->first();

        if ($latestTahunAjaran && $latestTahunAjaran->selesai > $this->mulai) {
            $this->addError('mulai', 'Tanggal mulai harus lebih besar dari tanggal selesai tahun ajaran sebelumnya (' . $latestTahunAjaran->selesai . ')');
            return false;
        }


        $createdTahunAjaran = TahunAjaran::create(
            [
                'name' => $this->name,
                'mulai' => $this->mulai,
                'selesai' => $this->selesai,
            ]
        );

        if ($this->importData) {

            dispatch(new ImportTahunAjaran($createdTahunAjaran, $this->importOptions));
        }

        return $createdTahunAjaran;
    }
}
