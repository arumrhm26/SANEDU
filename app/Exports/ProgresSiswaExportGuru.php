<?php

namespace App\Exports;

use App\Models\Indikator;
use App\Models\StudentIndikator;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProgresSiswaExportGuru implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings
{

    protected $materiId;
    protected $indikators;

    public function __construct($materiId)
    {
        $this->materiId = $materiId;
        $this->indikators = Indikator::whereHas('materi', function ($query) {
            $query->where('id', $this->materiId);
        })->get();
    }

    public function headings(): array
    {
        $headings = ['Nama Siswa'];

        foreach ($this->indikators as $indikator) {
            $headings[] = $indikator->name;
        }

        return $headings;
    }

    public function map($row): array
    {
        $data = [
            $row->student->user->name,
        ];

        foreach ($this->indikators as $indikator) {
            $nilai = $row
                ->where('indikator_id', $indikator->id)
                ->where('student_id', $row->student_id)
                ->first();
            $data[] = $nilai ? ($nilai->nilai == 0 ? "0" : $nilai->nilai) : "-";
        }

        return $data;
    }

    public function prepareRows($rows)
    {
        // Mengelompokkan data per siswa
        return $rows->groupBy('student_id')->map(function ($groupedRows) {
            // Menyimpan hanya satu entri per siswa
            return $groupedRows->first();
        })->values();
    }

    public function query()
    {
        return StudentIndikator::query()
            ->whereHas('indikator.materi', function ($query) {
                $query->where('id', $this->materiId);
            });
    }
}
