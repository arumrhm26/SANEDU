<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    public function classRooms()
    {
        return $this->hasMany(ClassRoom::class);
    }


    public function classRoomStudents()
    {
        return $this->hasMany(ClassRoomStudent::class);
    }
}
