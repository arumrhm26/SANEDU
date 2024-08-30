<?php

namespace App\Jobs;

use App\Models\ClassRoom;
use App\Models\ClassRoomStudent;
use App\Models\Student;
use App\Models\StudentIndikator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentAddeddToClassRoom implements ShouldQueue
{
    use Queueable;

    protected ClassRoom $classRoom;

    /**
     * Create a new job instance.
     */
    public function __construct(ClassRoom $classRoom)
    {
        $this->classRoom = $classRoom;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $students = $this->classRoom->students;
        $indikators = [];

        foreach ($this->classRoom->materis as $materi) {
            $indikators = array_merge($indikators, $materi->indikators->pluck('id')->toArray());
        }

        foreach ($students as $student) {
            DB::beginTransaction();
            try {
                $student->studentIndikators()->createMany(
                    collect($indikators)->map(function ($indikator) use ($student) {

                        // check if student already have indikator
                        $studentIndikator = $student->studentIndikators()
                            ->where('indikator_id', $indikator)
                            ->first();

                        if ($studentIndikator) {
                            return;
                        }

                        return [
                            'indikator_id' => $indikator,
                            'nilai' => 0,
                        ];
                    })
                );
                DB::commit();
                Log::info("Student " . $student->user->name . " added to class room " . $this->classRoom->full_name);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
            }
        }
    }
}
