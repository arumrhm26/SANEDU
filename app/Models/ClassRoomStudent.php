<?php

namespace App\Models;

use App\Observers\ClassRoomStudentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(ClassRoomStudentObserver::class)]
class ClassRoomStudent extends Model
{
    use HasFactory;

    protected $table = 'class_room_students';

    protected $fillable = [
        'class_room_id',
        'student_id',
        'tahun_ajaran_id',
        'grade_id',
    ];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }
}
