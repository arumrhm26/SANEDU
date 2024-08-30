<?php

namespace App\Models;

use App\Observers\StudentIndikatorOberserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(StudentIndikatorOberserver::class)]
class StudentIndikator extends Model
{
    use HasFactory;

    protected $table = 'student_indikator';

    protected $fillable = [
        'student_id',
        'indikator_id',
        'nilai',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function indikator()
    {
        return $this->belongsTo(Indikator::class, 'indikator_id', 'id');
    }
}
