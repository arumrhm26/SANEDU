<?php

namespace App\Models;

use App\Observers\ClassRoomObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(ClassRoomObserver::class)]
class ClassRoom extends Model
{
    use HasFactory, SoftDeletes;

    // protected $with = ['grade'];

    protected $fillable = [
        'name',
        'full_name',
        'jumlah_siswa',
        'limit_siswa',
        'tahun_ajaran_id',
        'cabang_id',
        'grade_id',
    ];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_room_students');
    }

    public function classRoomStudents()
    {
        return $this->hasMany(ClassRoomStudent::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'class_room_id', 'id');
    }

    public function materis()
    {
        return $this->hasManyThrough(Materi::class, Subject::class);
    }

    // create teacher count function if teache
    public function teacherCount()
    {
        return $this->subjects->pluck('teacher_id')->unique()->count();
    }
}
