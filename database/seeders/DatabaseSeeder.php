<?php

namespace Database\Seeders;

use App\Enums\Role as EnumsRole;
use App\Models\Cabang;
use App\Models\Grade;
use App\Models\PertemuanStatus;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // start make user each role
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        Role::create(['name' => EnumsRole::ADMIN]);
        Role::create(['name' => EnumsRole::SISWA]);
        Role::create(['name' => EnumsRole::GURU]);
        Role::create(['name' => EnumsRole::ORANGTUA]);

        // create 2 cabang
        Cabang::create([
            'nama' => 'Pahoman',
        ]);

        Cabang::create([
            'nama' => 'Korpri',
        ]);

        // create 3 grade
        Grade::create([
            'name' => 'X',
        ]);

        Grade::create([
            'name' => 'XI',
        ]);

        Grade::create([
            'name' => 'XII',
        ]);

        PertemuanStatus::create([
            'name' => 'Hadir',
        ]);

        PertemuanStatus::create([
            'name' => 'Belum Hadir',
        ]);

        PertemuanStatus::create([
            'name' => 'Izin',
        ]);

        PertemuanStatus::create([
            'name' => 'Terlambat',
        ]);


        // assign role to user
        $admin->assignRole(EnumsRole::ADMIN);


        // create 30 user and assign role exept admin and each user has random 1 role
        // User::factory(300)->create()->each(function ($user) {
        //     $role = Role::all()->random();

        //     while ($role->name === EnumsRole::ADMIN->value) {
        //         $role = Role::all()->random();
        //     }

        //     $user->assignRole($role->name);

        //     if ($role->name === EnumsRole::SISWA->value) {
        //         $user->student()->create([
        //             'asal_sekolah' => fake()->company(),
        //             'cabang_id' => fake()->randomElement(
        //                 Cabang::all()->pluck('id')->toArray()
        //             ),
        //         ]);
        //     }

        //     if ($role->name === EnumsRole::GURU->value) {
        //         $user->teacher()->create([
        //             'rekening_bank' => fake()->randomElement(['BRI', 'BCA', 'BNI', 'Mandiri']),
        //             'no_rekening' => fake()->bankAccountNumber(),
        //         ]);
        //     }

        //     if ($role->name === EnumsRole::ORANGTUA->value) {
        //         $user->studentParent()->create([
        //             'student_id' => fake()->randomElement(User::role(EnumsRole::SISWA->value)->pluck('id')->toArray()),
        //             'hubungan' => fake()->randomElement(['Ayah', 'Ibu', 'Wali']),
        //         ]);
        //     }
        // });



        // create 1 tahun ajaran
        $tahunAjaran = TahunAjaran::create([
            'name' => '2024/2025 Ganjil',
            'mulai' => now()->toDateString(),
            'selesai' => now()->addMonths(6)->toDateString(),
        ]);

        // create 2 classroom for each grade and classroom each have 5 subjects
        Grade::all()->each(function ($grade) use ($tahunAjaran) {
            Cabang::all()->each(function ($cabang) use ($grade, $tahunAjaran) {
                $cabang->classRooms()->create([
                    'name' => 'Soshum',
                    'grade_id' => $grade->id,
                    'full_name' => $grade->name . ' Soshum',
                    'limit_siswa' => fake()->randomElement([20, 25, 30, 35, 40]),
                    'tahun_ajaran_id' => $tahunAjaran->id,
                ])->subjects()->createMany([
                    [
                        'name' => 'Sosiologi',

                    ],
                    [
                        'name' => 'Sejarah',

                    ],
                    [
                        'name' => 'Ekonomi',

                    ],
                    [
                        'name' => 'Geografi',

                    ],
                    [
                        'name' => 'Matematika wajib',
                    ],
                ]);

                $cabang->classRooms()->create([
                    'name' => 'Saintek',
                    'grade_id' => $grade->id,
                    'full_name' => $grade->name . ' Saintek',
                    'limit_siswa' => fake()->randomElement([20, 25, 30, 35, 40]),
                    'tahun_ajaran_id' => $tahunAjaran->id,
                ])->subjects()->createMany([

                    [
                        'name' => 'Fisika',

                    ],
                    [
                        'name' => 'Kimia',

                    ],
                    [
                        'name' => 'Biologi',

                    ],
                    [
                        'name' => 'Matematika wajib',

                    ],
                    [
                        'name' => 'Matematika minat',

                    ],
                ]);
            });
        });

        // create 5 bab as materis for each subject
        \App\Models\Subject::all()->each(function ($subject) {
            $subject->materis()->createMany([
                [
                    'name' => 'Bab 1',
                ],
                [
                    'name' => 'Bab 2',
                ],
                [
                    'name' => 'Bab 3',
                ],
                [
                    'name' => 'Bab 4',
                ]
            ]);
        });

        // create 4 indikator for each materi
        \App\Models\Materi::all()->each(function ($materi) {
            $materi->indikators()->createMany([
                [
                    'name' => 'Indikator 1',
                ],
                [
                    'name' => 'Indikator 2',
                ],
                [
                    'name' => 'Indikator 3',
                ],
                [
                    'name' => 'Indikator 4',
                ],
                [
                    'name' => 'Evaluasi',
                ]
            ]);
        });
    }
}
