<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertemuanStudent extends Model
{
    use HasFactory;

    protected $table = 'pertemuan_students';

    protected $fillable = [
        'jam_masuk',
        'pertemuan_id',
        'student_id',
        'pertemuan_status_id',
    ];


    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class, 'pertemuan_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function pertemuanStatus()
    {
        return $this->belongsTo(PertemuanStatus::class, 'pertemuan_status_id', 'id');
    }
}
