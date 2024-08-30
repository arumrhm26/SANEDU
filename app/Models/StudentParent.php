<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentParent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'hubungan',
    ];

    public function child()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
