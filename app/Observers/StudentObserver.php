<?php

namespace App\Observers;

use App\Jobs\StudentAddeddToClassRoom;
use App\Models\ClassRoom;
use App\Models\ClassRoomStudent;
use App\Models\Student;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Log;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        // cek apakah siswa mengubah cabang
        if ($student->isDirty('cabang_id')) {

            // ambil tahun ajaran saat ini
            $now = now();
            $tahunAjaran = TahunAjaran::where('mulai', '<=', $now)->where('selesai', '>=', $now)->first()->id;

            if (!$tahunAjaran) {
                return;
            }

            // cek apakah siswa sudah terdaftar pada kelas pada tahun ajaran saat ini
            $classRoomStudent = ClassRoomStudent::query()
                ->where('student_id', $student->id)
                ->whereHas('classRoom', function ($query) use ($tahunAjaran) {
                    $query->where('tahun_ajaran_id', $tahunAjaran);
                })
                ->first();

            if (!$classRoomStudent) {
                return;
            }

            // ambil classroom dengan grade yang sama dan tahun ajaran yang sama dengan cabang yang baru
            $newClassRoom = ClassRoom::query()
                ->where('grade_id', $classRoomStudent->grade_id)
                ->where('cabang_id', $student->cabang_id)
                ->where('tahun_ajaran_id', $tahunAjaran)
                ->where('name', $classRoomStudent->classRoom->name)
                ->first();

            // cek apakah siswa sudah terdaftar juga pada kelas yang baru
            $isExist = ClassRoomStudent::query()
                ->where('student_id', $student->id)
                ->where('class_room_id', $newClassRoom->id)
                ->where('tahun_ajaran_id', $tahunAjaran)
                ->first();

            if ($isExist) {
                return;
            }

            // jika siswa sudah terdaftar pada kelas pada tahun ajaran saat ini maka daftarkan ke dalam kelas yang baru
            ClassRoomStudent::create([
                'class_room_id' => $newClassRoom->id,
                'student_id' => $student->id,
                'tahun_ajaran_id' => $tahunAjaran,
                'grade_id' => $classRoomStudent->grade_id,
            ]);

            dispatch(new StudentAddeddToClassRoom($newClassRoom));
        }
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }
}
