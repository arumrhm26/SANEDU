<?php

namespace App\Observers;

use App\Models\Indikator;

class IndikatorObserver
{
    /**
     * Handle the Indikator "created" event.
     */
    public function created(Indikator $indikator): void
    {
        $indikators = Indikator::where('materi_id', $indikator->materi_id)->get();

        $indikator->code = "{$indikator?->materi?->code}.{$indikators->count()}";

        $indikator->save();
    }

    /**
     * Handle the Indikator "updated" event.
     */
    public function updated(Indikator $indikator): void
    {
        //
    }

    /**
     * Handle the Indikator "deleted" event.
     */
    public function deleted(Indikator $indikator): void
    {
        //
    }

    /**
     * Handle the Indikator "restored" event.
     */
    public function restored(Indikator $indikator): void
    {
        //
    }

    /**
     * Handle the Indikator "force deleted" event.
     */
    public function forceDeleted(Indikator $indikator): void
    {
        //
    }
}
