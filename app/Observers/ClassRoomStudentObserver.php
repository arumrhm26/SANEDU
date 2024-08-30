<?php

namespace App\Observers;

use App\Jobs\StudentAddeddToClassRoom;
use App\Models\ClassRoomStudent;
use App\Models\StudentIndikator;

class ClassRoomStudentObserver
{
    /**
     * Handle the ClassRoomStudent "created" event.
     */
    public function created(ClassRoomStudent $classRoomStudent): void
    {
        // create many student indikator with check contidion

        // TODO: OPTIMIZE THIS
        // dispatch(new StudentAddeddToClassRoom($classRoomStudent));
    }

    /**
     * Handle the ClassRoomStudent "updated" event.
     */
    public function updated(ClassRoomStudent $classRoomStudent): void
    {
        //
    }

    /**
     * Handle the ClassRoomStudent "deleted" event.
     */
    public function deleted(ClassRoomStudent $classRoomStudent): void
    {
        //
    }

    /**
     * Handle the ClassRoomStudent "restored" event.
     */
    public function restored(ClassRoomStudent $classRoomStudent): void
    {
        //
    }

    /**
     * Handle the ClassRoomStudent "force deleted" event.
     */
    public function forceDeleted(ClassRoomStudent $classRoomStudent): void
    {
        //
    }
}
