<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TahunAjaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'mulai',
        'selesai',
    ];

    public function classRooms()
    {
        return $this->hasMany(ClassRoom::class);
    }

    public function classRoomStudents()
    {
        return $this->hasMany(ClassRoomStudent::class);
    }

    public function teacherCount()
    {
        // count all teacher in teacher model
        return Teacher::count();
    }

    public function getBulan()
    {
        $mulai = $this->mulai;
        $selesai = $this->selesai;

        $start = new \DateTime($mulai);
        $end = new \DateTime($selesai);

        $interval = \DateInterval::createFromDateString('1 month');
        $period = new \DatePeriod($start, $interval, $end);

        $bulans = [];
        foreach ($period as $dt) {
            $bulans[] = (object) [
                // delete 0 in front of bulan
                'id' => ltrim($dt->format("m"), '0'),
                'name' => $dt->format("F"),
            ];
        }

        return $bulans;
    }
}
