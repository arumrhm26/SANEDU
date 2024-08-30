<?php

use App\Http\Controllers\User\SiswaController;
use App\Livewire\Guru\GuruProgresPembelajaran;
use App\Livewire\User\Guru\DaftarProgresSiswa;
use App\Livewire\User\Guru\DetailPresensi;
use App\Livewire\User\Guru\Presensi;
use Illuminate\Support\Facades\Route;


Route::group(
    [
        'prefix' => 'guru',
        'middleware' => ['verified', 'auth', 'role:guru']
    ],

    function () {
        Route::get('/', [SiswaController::class, 'index'])->name('guru.index');

        Route::get('/presensi/{pertemuan}', DetailPresensi::class)->name('guru.presensi-detail');
        Route::get('/presensi', Presensi::class)->name('guru.presensi');

        Route::get('/progres-pembelajaran-guru', GuruProgresPembelajaran::class)->name('guru.progres-pembelajaran');
        Route::get('/progres-pembelajaran-guru/{subject}/{student}', DaftarProgresSiswa::class)->name('guru.progres-pembelajaran.show');
    }
);
