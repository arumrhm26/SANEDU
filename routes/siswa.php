<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\Siswa;
use App\Http\Controllers\User;


// user routes
Route::group(
    [
        'prefix' => 'siswa',
        'middleware' => ['verified', 'auth', 'role:siswa']
    ],

    function () {
        Route::get('/', [User\SiswaController::class, 'index'])->name('siswa.index');
        Route::get('/scan-qr', [Siswa\QrController::class, 'index'])->name('siswa.scan-qr');
        Route::post('/scan-qr', [Siswa\QrController::class, 'store'])->name('siswa.scan-qr.store');
        Route::get('/riwayat-kehadiran', [Siswa\RiwayatKehadiran::class, 'index'])->name('siswa.riwayat-kehadiran');
        Route::get('/progres-pembelajaran', [Siswa\ProgresPembelajaran::class, 'index'])->name('siswa.progres-pembelajaran');
    }
);
