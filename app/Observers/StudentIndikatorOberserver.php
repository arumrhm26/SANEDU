<?php

namespace App\Observers;

use App\Events\StudenIndikatorFullFilled;
use App\Models\StudentIndikator;
use Illuminate\Support\Facades\Log;

class StudentIndikatorOberserver
{
    /**
     * Handle the StudentIndikator "created" event.
     */
    public function created(StudentIndikator $studentIndikator): void
    {
        //
    }

    /**
     * Handle the StudentIndikator "updated" event.
     */
    public function updated(StudentIndikator $studentIndikator): void
    {
        $student = $studentIndikator->student;
        $materi = $studentIndikator->indikator->materi;
        event(new StudenIndikatorFullFilled($materi, $student));
    }

    /**
     * Handle the StudentIndikator "deleted" event.
     */
    public function deleted(StudentIndikator $studentIndikator): void
    {
        //
    }

    /**
     * Handle the StudentIndikator "restored" event.
     */
    public function restored(StudentIndikator $studentIndikator): void
    {
        //
    }

    /**
     * Handle the StudentIndikator "force deleted" event.
     */
    public function forceDeleted(StudentIndikator $studentIndikator): void
    {
        //
    }
}
