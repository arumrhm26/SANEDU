<?php

namespace App\Listeners;

use App\Events\StudenIndikatorFullFilled;
use App\Models\StudentIndikator;
use App\Models\StudentParent;
use App\Models\User;
use App\Notifications\StudentIndikatorNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendStudentIndikatorNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StudenIndikatorFullFilled $event): void
    {
        $indikatorsCount = $event->materi->indikators->count();
        $studentIndikators = StudentIndikator::where('student_id', $event->student->id)
            ->whereIn('indikator_id', $event->materi->indikators->pluck('id'))
            ->whereColumn('updated_at', '>', 'created_at')
            ->get();

        if ($studentIndikators->count() === $indikatorsCount) {
            $studentUserId = $event->student->user->id;

            $studentParents = StudentParent::where('student_id', $studentUserId)->get();

            foreach ($studentParents as $studentParent) {
                $parent = User::find($studentParent->user_id);
                $parent->notify(new StudentIndikatorNotification($event->materi, $event->student));
            }
        }
    }
}
