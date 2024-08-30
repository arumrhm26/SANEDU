<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertemuanStatus extends Model
{
    use HasFactory;

    protected $table = 'pertemuan_statuses';

    protected $fillable = [
        'name',
    ];

    public function pertemuanStudents()
    {
        return $this->hasMany(PertemuanStudent::class);
    }
}
