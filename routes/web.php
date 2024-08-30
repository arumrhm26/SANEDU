<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\User;
use App\Livewire\Qrcode\QrcodeShow;
use App\Livewire\User\Pengaturan;


Route::get('/', DashboardController::class);

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['verified', 'auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/settings', Pengaturan::class)
    ->middleware(['auth'])
    ->name('settings');

Route::get('/qr-code/{pertemuan}', QrcodeShow::class)->middleware(['auth', 'role:admin|guru'])->name('qr-code');

Route::group(
    [
        'middleware' => ['verified', 'auth']
    ],

    function () {
        Route::get('/download-progres-pembelajaran/{materi}', [PDFController::class, 'progresPembelajaran'])->name('siswa.progres-pembelajaran.pdf');
        Route::get('/download-riwayat-kehadiran/{tahunAjaran}', [PDFController::class, 'riwayatKehadiran'])->name('siswa.riwayat-kehadiran.pdf');
        Route::get('/download-rekapan-absen/{pertemuan}', [PDFController::class, 'rekapanAbsen'])->name('rekapan-absen.pdf');
        Route::get('/download-rekapan-progres/{materi}', [PDFController::class, 'rekapanProgres'])->name('rekapan-progres.pdf');
        Route::get('/download-rekapan-progres-guru/{subject}', [PDFController::class, 'rekapanProgresGuru'])->name('rekapan-progres-guru.pdf');
    }
);



require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/siswa.php';
require __DIR__ . '/guru.php';
require __DIR__ . '/orangtua.php';
