<?php

namespace App\Models;

use App\Observers\StudentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(StudentObserver::class)]
class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $with = ['user'];

    protected $fillable = [
        'asal_sekolah',
        'cabang_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studentParent()
    {
        return $this->belongsToMany(User::class, 'student_parents', 'student_id', 'user_id');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }

    public function classRooms()
    {
        return $this->belongsToMany(ClassRoom::class, 'class_room_students');
    }

    public function classRoomStudents()
    {
        return $this->hasMany(ClassRoomStudent::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function materis()
    {
        return $this->belongsToMany(Materi::class);
    }

    public function pertemuanStudents()
    {
        return $this->hasMany(PertemuanStudent::class);
    }

    public function studentIndikators()
    {
        return $this->hasMany(StudentIndikator::class, 'student_id', 'id');
    }
}
