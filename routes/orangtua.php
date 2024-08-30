<?php

use App\Http\Controllers\User\SiswaController;
use App\Livewire\User\OrangTua\KehadiranSiswa;
use App\Livewire\User\OrangTua\PorgresPembelajaranSiswa;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'orangtua',
        'middleware' => ['verified', 'auth', 'role:orangtua']
    ],

    function () {
        Route::get('/', [SiswaController::class, 'index'])->name('orangtua.index');
        Route::get('/kehadiran-siswa', KehadiranSiswa::class)->name('orangtua.kehadiran-siswa');
        Route::get('/progres-pembelajaran-siswa', PorgresPembelajaranSiswa::class)->name('orangtua.progres-pembelajaran-siswa');
    }
);
