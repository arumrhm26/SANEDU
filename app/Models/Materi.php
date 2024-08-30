<?php

namespace App\Models;

use App\Observers\MateriObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(MateriObserver::class)]
class Materi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'subject_id',
        'name',
        'code',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function indikators()
    {

        return $this->hasMany(Indikator::class);
    }

    public function pertemuans()
    {
        return $this->hasMany(Pertemuan::class);
    }
}
