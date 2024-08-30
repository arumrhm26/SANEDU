<?php

namespace App\Jobs;

use App\Models\ClassRoom;
use App\Models\Indikator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IndikatorAddeddToClassRoom implements ShouldQueue
{
    use Queueable;

    protected ClassRoom $classRoom;
    protected Indikator $indikator;


    /**
     * Create a new job instance.
     */
    public function __construct(ClassRoom $classRoom, Indikator $indikator)
    {
        $this->indikator = $indikator;
        $this->classRoom = $classRoom;
    }



    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $students = $this->classRoom->students;
        $indikators = $this->indikator->id;

        foreach ($students as $student) {
            $student->studentIndikators()->create([
                'indikator_id' => $indikators,
                'nilai' => 0,
            ]);
        }
    }
}
