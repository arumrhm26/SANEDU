<?php

namespace App\Jobs;

use App\Models\TahunAjaran;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportTahunAjaran implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */

    public TahunAjaran $tahunAjaran;
    public array $options;

    public function __construct(TahunAjaran $tahunAjaran, array $options)
    {
        $this->tahunAjaran = $tahunAjaran;
        $this->options = $options;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Importing data for tahun ajaran ' . $this->tahunAjaran->name);
        Log::info('Selected Options', $this->options);
        try {

            $tahunAjaran = $this->tahunAjaran;

            $selectedImportTahunAjaran = TahunAjaran::find($this->options['tahunAjaranId']);

            if (!$selectedImportTahunAjaran) {
                return;
            }

            Log::info('Importing data for tahun ajaran ' . $selectedImportTahunAjaran->name);

            // check if options is contain class room true
            if ($this->options['kelas']) {

                Log::info('Importing data for class room ' . $selectedImportTahunAjaran->classRooms->count());

                DB::beginTransaction();

                // get all classRooms, and insisde each classRoom get all subjects and inside each subject get all materis and inside each materi get all indikators
                $selectedImportTahunAjaran->classRooms->each(function ($classRoom) use ($tahunAjaran) {

                    $newClassRoom = $tahunAjaran->classRooms()->create([
                        'name' => $classRoom->name,
                        'limit_siswa' => $classRoom->limit_siswa,
                        'tahun_ajaran_id' => $tahunAjaran->id,
                        'cabang_id' => $classRoom->cabang_id,
                        'grade_id' => $classRoom->grade_id
                    ]);

                    $classRoom->subjects->each(function ($subject) use ($newClassRoom) {
                        $newSubject = $newClassRoom->subjects()->create([
                            'name' => $subject->name,
                            'teacher_id' => $subject->teacher_id,
                            'class_room_id' => $newClassRoom->id
                        ]);

                        $subject->materis->each(function ($materi) use ($newSubject) {
                            $newMateri = $newSubject->materis()->create([
                                'name' => $materi->name,
                                'subject_id' => $newSubject->id
                            ]);

                            $materi->indikators->each(function ($indikator) use ($newMateri) {
                                $newMateri->indikators()->create([
                                    'name' => $indikator->name,
                                    'materi_id' => $newMateri->id
                                ]);
                            });
                        });
                    });

                    // check if options is contain students true
                    if ($this->options['siswa']) {

                        Log::info('Import student from ' . $classRoom->name . ' to class room ' . $newClassRoom->name);

                        $newClassRoom->classRoomStudents()->createMany(
                            $classRoom->students->map(function ($student) use ($newClassRoom) {
                                return [
                                    'student_id' => $student->id,
                                    'tahun_ajaran_id' => $this->tahunAjaran->id,
                                    'grade_id' => $newClassRoom->grade_id,
                                ];
                            })->toArray()
                        );

                        dispatch(new StudentAddeddToClassRoom($newClassRoom));

                        Log::info('Import student from ' . $classRoom->name . ' to class room ' . $newClassRoom->name . ' success');
                    }
                });
                DB::commit();

                Log::info('Importing data for class room ' . $selectedImportTahunAjaran->classRooms->count() . ' success');
            }
        } catch (\Throwable $th) {

            DB::rollBack();

            Log::error($th);
        }
    }
}
