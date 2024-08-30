<?php

namespace App\Models;

use App\Observers\IndikatorObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(IndikatorObserver::class)]
class Indikator extends Model
{
    use HasFactory;

    protected $fillable = [
        'materi_id',
        'name',
        'code',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    public function studentIndikators()
    {
        return $this->hasMany(StudentIndikator::class, 'indikator_id', 'id');
    }
}
