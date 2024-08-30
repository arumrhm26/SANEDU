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
        return $this->classRooms->map(function ($classRoom) {
            return $classRoom->teacherCount();
        })->sum();
    }
}
