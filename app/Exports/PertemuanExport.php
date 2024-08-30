<?php

namespace App\Exports;

use App\Models\PertemuanStudent;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PertemuanExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings
{
    use Exportable;

    protected $pertemuanId;

    public function forPertemuanId($pertemuanId)
    {
        $this->pertemuanId = $pertemuanId;

        return $this;
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Waktu Hadir',
            'Status',
        ];
    }

    public function map($row): array
    {
        return [
            $row->student->user->name,
            $row->waktu_hadir,
            $row->pertemuanStatus->name,
        ];
    }


    public function query()
    {
        return PertemuanStudent::query()
            ->whereHas('pertemuan', function ($query) {
                $query->where('id', $this->pertemuanId);
            });
    }
}
