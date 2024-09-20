<?php

use App\Livewire\Admin as LivewireAdmin;
use App\Livewire\Admin\User as LivewireAdminUser;
use App\Livewire\Admin\ProgresSiswa as LivewireAdminKelolaProgres;
use App\Http\Controllers\AdminController;
use App\Livewire\Admin\Absen\RekapanAbsen;
use App\Livewire\Admin\Absen\RekapanAbsen\DetailAbsen;
use App\Livewire\Admin\User\Kelas\DetailMataPelajaran;
use App\Livewire\Admin\User\Kelas\DetailSiswa;
use Illuminate\Support\Facades\Route;



// admin routes
Route::group(
    [
        'prefix' => 'admin',
        'middleware' => ['auth', 'role:admin']
    ],
    function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');

        Route::prefix('user')->group(
            function () {

                Route::get('/verifikasi-akun', LivewireAdminUser\VerifikasiUserTable::class)->name('admin.verifikasi-akun');
                Route::get('/guru', LivewireAdminUser\GuruTable::class)->name('admin.guru');
                Route::get('/siswa', LivewireAdminUser\SiswaTable::class)->name('admin.siswa');
                Route::get('/orangtua', LivewireAdminUser\OrangtuaTable::class)->name('admin.orangtua');

                Route::get('/detail/{user}', LivewireAdminUser\DetailUser::class)->name('admin.user.show');

                Route::prefix('tahun-ajaran-kelas')->group(
                    function () {
                        Route::get('/', LivewireAdminUser\TahunAjaranTable::class)->name('admin.tahunajarankelas');
                        Route::get('/{tahunAjaran}', LivewireAdmin\DetailTahunAjaran::class)->name('admin.tahunajarankelas.show');
                        Route::get('/{tahunAjaran}/kelas/{classRoom}', LivewireAdmin\DetailKelas::class)->name('admin.tahunajarankelas.kelas.show');
                        Route::get('/{tahunAjaran}/kelas/{classRoom}/siswa/{student}', DetailSiswa::class)->name('admin.tahunajarankelas.kelas.siswa');
                        Route::get('/{tahunAjaran}/kelas/{classRoom}/mata-pelajaran/{subject}', DetailMataPelajaran::class)->name('admin.tahunajarankelas.kelas.matapelajaran');
                    }
                );
            }
        );

        Route::prefix('absen')->group(
            function () {
                Route::get('/', LivewireAdmin\Absensi::class)->name('admin.absen');
                Route::get('/rekapan', RekapanAbsen::class)->name('admin.absen.rekapan');
                Route::get('/{pertemuan}', DetailAbsen::class)->name('admin.absen.show');
            }
        );

        Route::prefix('progres-siswa')->group(
            function () {

                Route::prefix('kelola')->group(
                    function () {
                        Route::get('/', LivewireAdminKelolaProgres\KelolaProgresSiswa::class)->name('admin.kelola-progres-siswa');
                        Route::get('/materi/{materi}', LivewireAdmin\DetailMateri::class)->name('admin.kelola-progres.materi');
                    }
                );

                Route::get('/rekapan', LivewireAdminKelolaProgres\RekapanProgresSiswa::class)->name('admin.rekapan-progres-siswa');


                Route::get('/hasil', LivewireAdminKelolaProgres\HasilProgresSiswa::class)->name('admin.hasil-progres-siswa');
            }
        );

        Route::prefix('master-data')->group(
            function () {
                Route::get('/', LivewireAdmin\MasterData::class)->name('admin.master-data');
            }
        );
    }
);
