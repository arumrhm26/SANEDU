<?php

namespace App\Observers;

use App\Models\Materi;
use Illuminate\Support\Facades\Log;

class MateriObserver
{
    /**
     * Handle the Materi "created" event.
     */
    public function created(Materi $materi): void
    {
        $subjectId = $materi->subject_id;

        $materis = Materi::where('subject_id', $subjectId)->get();

        $materi->code = "{$subjectId}.{$materis->count()}";

        $materi->save();
    }

    /**
     * Handle the Materi "updated" event.
     */
    public function updated(Materi $materi): void
    {
        //
    }

    /**
     * Handle the Materi "deleted" event.
     */
    public function deleted(Materi $materi): void
    {
        //
    }

    /**
     * Handle the Materi "restored" event.
     */
    public function restored(Materi $materi): void
    {
        //
    }

    /**
     * Handle the Materi "force deleted" event.
     */
    public function forceDeleted(Materi $materi): void
    {
        //
    }
}
