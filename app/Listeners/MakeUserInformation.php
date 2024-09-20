<?php

namespace App\Listeners;


use App\Enums\Role;
use App\Models\User;
// use Illuminate\Auth\Events\Registered as EventsRegistered;
use App\Events\RegisteredUser as EventsRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class MakeUserInformation
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
    public function handle(EventsRegistered $event): void
    {
        $user = User::find($event->user->id);
        $user->getRoleNames()->first() === Role::SISWA->value ? $this->createSiswa($event) : null;
        $user->getRoleNames()->first() === Role::ORANGTUA->value ? $this->createOrangTua($event) : null;
        $user->getRoleNames()->first() === Role::GURU->value ? $this->createGuru($event) : null;
    }

    public function createSiswa(EventsRegistered $event): void
    {
        $user = User::find($event->user->id);

        $user->student()->create(
            [
                'asal_sekolah' => $event->input['asal_sekolah'],
                'cabang_id' => $event->input['cabang'],
            ]
        );
    }

    public function createOrangTua(EventsRegistered $event): void
    {
        $user = User::find($event->user->id);
        $studentId = User::where('email', $event->input['student_email'])->first()->id;
        $parent = $user->studentParent()->create(
            [
                'hubungan' => $event->input['hubungan'],
                'student_id' => $studentId,
            ]
        );
    }

    public function createGuru(EventsRegistered $event): void
    {
        $user = User::find($event->user->id);
        $user->teacher()->create([
            'rekening_bank' => $event->input['rekening_bank'],
            'no_rekening' => $event->input['no_rekening'],
            'no_wa' => $event->input['no_wa'],
        ]);
    }
}
