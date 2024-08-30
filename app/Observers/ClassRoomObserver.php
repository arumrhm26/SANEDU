<?php

namespace App\Observers;

use App\Jobs\ClassRoomDeleted;
use App\Models\ClassRoom;
use App\Models\StudentIndikator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClassRoomObserver
{
    /**
     * Handle the ClassRoom "created" event.
     */
    public function created(ClassRoom $classRoom): void
    {
        $name = str($classRoom->name)->title();
        $classRoom->update(
            ['full_name' => "{$classRoom->grade->name} {$name} {$classRoom->cabang->nama}"]
        );
        unset($name);
    }

    /**
     * Handle the ClassRoom "updated" event.
     */
    public function updated(ClassRoom $classRoom): void {}

    /**
     * Handle the ClassRoom "updating" event.
     */
    public function updating(ClassRoom $classRoom): void
    {
        $classRoom->full_name = "{$classRoom->grade->name} {$classRoom->name} {$classRoom->cabang->nama}";
    }

    /**
     * Handle the ClassRoom "deleting" event.
     */
    public function deleting(ClassRoom $classRoom): void
    {
        dispatch(new ClassRoomDeleted($classRoom));
    }
    /**
     * Handle the ClassRoom "deleted" event.
     */
    // public function deleted(ClassRoom $classRoom): void
    // {
    //     dispatch(new ClassRoomDeleted($classRoom));
    //     $classRoom->classRoomStudents()->delete();
    // }

    /**
     * Handle the ClassRoom "restored" event.
     */
    public function restored(ClassRoom $classRoom): void
    {
        //
    }

    /**
     * Handle the ClassRoom "force deleted" event.
     */
    public function forceDeleted(ClassRoom $classRoom): void
    {
        //
    }
}
