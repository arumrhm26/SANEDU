<?php

namespace App\Jobs;

use App\Models\ClassRoom;
use App\Models\Pertemuan;
use App\Models\PertemuanStudent;
use App\Models\StudentIndikator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClassRoomDeleted implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */

    protected ClassRoom $classRoom;

    public function __construct(ClassRoom $classRoom)
    {
        $this->classRoom = $classRoom;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $students = $this->classRoom->students->pluck('id')->toArray();

        // get all materi id from each subjects in classroom
        $materis = $this->classRoom->subjects->map(function ($subject) {
            return $subject->materis->pluck('id')->toArray();
        })->flatten()->toArray();

        try {

            DB::beginTransaction();
            StudentIndikator::whereIn('student_id', $students)->delete();
            DB::commit();


            DB::beginTransaction();
            $pertemuanIds = Pertemuan::whereIn('materi_id', $materis)->pluck('id')->toArray();
            PertemuanStudent::whereIn('pertemuan_id', $pertemuanIds)
                ->delete();
            Pertemuan::whereIn('materi_id', $materis)->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        $this->classRoom->classRoomStudents()->delete();
    }
}
