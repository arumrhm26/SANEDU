<?php

namespace App\Jobs;

use App\Models\Pertemuan;
use App\Models\PertemuanStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PertemuanCreated implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */

    protected Pertemuan $pertemuan;
    public function __construct(Pertemuan $pertemuan)
    {
        $this->pertemuan = $pertemuan;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $students = $this->pertemuan->materi->subject->classRoom->students;


        Log::info("Pertemuan {$this->pertemuan->name} created in {$this->pertemuan->materi->name}");
        Log::info("classrom student", $students->map(function ($student) {
            return [
                'student_id' => $student->id,
            ];
        })->toArray());

        try {
            DB::beginTransaction();
            $this->pertemuan->pertemuanStudents()->createMany(
                $students->map(function ($student) {
                    return [
                        'student_id' => $student->id,
                        'pertemuan_status_id' => PertemuanStatus::where('name', 'Belum Hadir')->first()->id,
                    ];
                })->toArray()
            );
            DB::commit();
            Log::info("Pertemuan {$this->pertemuan->name} created in {$this->pertemuan->materi->name}");
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Failed to create pertemuan {$this->pertemuan->name} in {$this->pertemuan->materi->name}");
            Log::error($th->getMessage());
        }
    }
}
