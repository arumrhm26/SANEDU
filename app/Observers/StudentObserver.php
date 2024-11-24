<?php

namespace App\Observers;

use App\Jobs\StudentAddeddToClassRoom;
use App\Models\ClassRoom;
use App\Models\ClassRoomStudent;
use App\Models\Indikator;
use App\Models\Student;
use App\Models\StudentIndikator;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\DB;
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

            $newClassRoom = ClassRoom::query()
                ->where('grade_id', $classRoomStudent->grade_id)
                ->where('cabang_id', $student->cabang_id)
                ->where('tahun_ajaran_id', $tahunAjaran)
                ->where('name', $classRoomStudent->classRoom->name)
                ->first();

            if (!$newClassRoom) {
                return;
            }

            Log::info(json_encode($classRoomStudent->classRoom->full_name));
            Log::info(json_encode($newClassRoom->full_name));

            // get all old student indikator
            $oldStudentIndikators = StudentIndikator::query()
                ->where('student_id', $student->id)
                ->whereHas('indikator.materi.subject.classRoom', function ($query) use ($classRoomStudent) {
                    $query->where('id', $classRoomStudent->class_room_id);
                })
                ->with(['indikator.materi.subject'])
                ->get()
                ->groupBy([
                    'indikator.materi.subject.name',
                    'indikator.materi.name',
                ])
                ->toArray();

            // create new class room student from new class room
            $isExist = ClassRoomStudent::query()
                ->where('student_id', $student->id)
                ->where('class_room_id', $newClassRoom->id)
                ->where('tahun_ajaran_id', $tahunAjaran)
                ->first();

            if ($isExist) {
                return;
            }

            $newClassRoomStudent = ClassRoomStudent::create([
                'student_id' => $student->id,
                'class_room_id' => $newClassRoom->id,
                'tahun_ajaran_id' => $tahunAjaran,
                'grade_id' => $classRoomStudent->grade_id,
            ]);

            // insert all old student indikator to new class room student
            foreach ($oldStudentIndikators as $subject => $materi) {
                foreach ($materi as $materiName => $indikators) {
                    foreach ($indikators as $indikator) {
                        $newIndikator = Indikator::query()
                            ->whereHas('materi.subject.classRoom', function ($query) use ($newClassRoom) {
                                $query->where('id', $newClassRoom->id);
                            })
                            ->whereHas('materi.subject', function ($query) use ($subject) {
                                $query->where('name', $subject);
                            })
                            ->whereHas('materi', function ($query) use ($materiName) {
                                $query->where('name', $materiName);
                            })
                            ->where('name', $indikator['indikator']['name'])
                            ->first();

                        if (!$newIndikator) {
                            continue;
                        }

                        DB::transaction(function () use ($student, $newIndikator, $indikator, $newClassRoomStudent) {
                            StudentIndikator::create([
                                'student_id' => $student->id,
                                'indikator_id' => $newIndikator->id,
                                'nilai' => $indikator['nilai'],
                                'class_room_student_id' => $newClassRoomStudent->id,
                            ]);

                            // delete old student indikator
                            StudentIndikator::query()
                                ->where('student_id', $student->id)
                                ->where('indikator_id', $indikator['indikator']['id'])
                                ->delete();
                        });
                    }
                }
            }

            // delete old class room student
            $classRoomStudent->delete();
            return;
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
