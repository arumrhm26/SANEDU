<?php // routes/breadcrumbs.php

use App\Models\ClassRoom;
use App\Models\Materi;
use App\Models\Pertemuan;
use App\Models\Student;
use App\Models\Subject;
use App\Models\TahunAjaran;
use Diglactic\Breadcrumbs\Breadcrumbs;

use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Illuminate\Support\Facades\Auth;

// admin routes

Breadcrumbs::for('admin.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.index'));
});

Breadcrumbs::for('admin.verifikasi-akun', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Verifikasi Akun', route('admin.verifikasi-akun'));
});

Breadcrumbs::for('admin.siswa', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Siswa', route('admin.siswa'));
});

Breadcrumbs::for('admin.guru', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Guru', route('admin.guru'));
});

Breadcrumbs::for('admin.orangtua', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Orang Tua', route('admin.orangtua'));
});

Breadcrumbs::for('admin.tahunajarankelas', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Tahun Ajaran Kelas', route('admin.tahunajarankelas'));
});

Breadcrumbs::for('admin.user.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.index');
    $trail->push('Detail User', route('admin.user.show', $user));
});

Breadcrumbs::for('admin.tahunajarankelas.show', function (BreadcrumbTrail $trail, TahunAjaran $tahunAjaran) {
    $trail->parent('admin.tahunajarankelas');
    $trail->push($tahunAjaran->name, route('admin.tahunajarankelas.show', $tahunAjaran));
});

Breadcrumbs::for('admin.tahunajarankelas.kelas.show', function (BreadcrumbTrail $trail, TahunAjaran $tahunAjaran, $classRoom) {
    $trail->parent('admin.tahunajarankelas.show', $tahunAjaran);
    $trail->push($classRoom->full_name, route('admin.tahunajarankelas.kelas.show', [$tahunAjaran, $classRoom]));
});

Breadcrumbs::for('admin.tahunajarankelas.kelas.siswa', function (BreadcrumbTrail $trail, TahunAjaran $tahunAjaran, ClassRoom $classRoom, Student $student) {
    $trail->parent('admin.tahunajarankelas.kelas.show', $tahunAjaran, $classRoom);
    $trail->push($student->user->name, route('admin.tahunajarankelas.kelas.siswa', [$tahunAjaran, $classRoom, $student]));
});

Breadcrumbs::for('admin.tahunajarankelas.kelas.matapelajaran', function (BreadcrumbTrail $trail, TahunAjaran $tahunAjaran, ClassRoom $classRoom, Subject $subject) {
    $trail->parent('admin.tahunajarankelas.kelas.show', $tahunAjaran, $classRoom);
    $trail->push($subject->name, route('admin.tahunajarankelas.kelas.matapelajaran', [$tahunAjaran, $classRoom, $subject]));
});

Breadcrumbs::for('admin.absen', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Absen', route('admin.absen'));
});

Breadcrumbs::for('admin.absen.show', function (BreadcrumbTrail $trail, Pertemuan $pertemuan) {
    $trail->parent('admin.absen');
    $trail->push($pertemuan->materi->name, route('admin.absen.show', $pertemuan));
});

Breadcrumbs::for('admin.kelola-progres-siswa', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Kelola Progres Siswa', route('admin.kelola-progres-siswa'));
});

Breadcrumbs::for('admin.kelola-progres.materi', function (BreadcrumbTrail $trail, Materi $materi) {
    $trail->parent('admin.kelola-progres-siswa');
    $trail->push($materi->name, route('admin.kelola-progres.materi', $materi));
});

Breadcrumbs::for('admin.kelola-progres.indikator', function (BreadcrumbTrail $trail, Materi $materi, $indikator) {
    $trail->parent('admin.kelola-progres.materi', $materi);
    $trail->push($indikator->name, route('admin.kelola-progres.indikator', [$materi, $indikator]));
});

Breadcrumbs::for('admin.rekapan-progres-siswa', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Rekapan Progres Siswa', route('admin.rekapan-progres-siswa'));
});

Breadcrumbs::for('admin.hasil-progres-siswa', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Hasil Progres Siswa', route('admin.hasil-progres-siswa'));
});

// siswa routes
Breadcrumbs::for('siswa.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('siswa.index'));
});

Breadcrumbs::for('settings', function (BreadcrumbTrail $trail) {
    $role = Auth::user()->roles->first()->name;
    $trail->parent($role . '.index');

    $trail->push('Pengaturan', route('settings'));
});

Breadcrumbs::for('siswa.riwayat-kehadiran', function (BreadcrumbTrail $trail) {
    $trail->parent('siswa.index');

    $trail->push('Riwayat Kehadiran', route('siswa.riwayat-kehadiran'));
});

Breadcrumbs::for('siswa.progres-pembelajaran', function (BreadcrumbTrail $trail) {
    $trail->parent('siswa.index');

    $trail->push('Progres Pembelajaran', route('siswa.progres-pembelajaran'));
});

// orang-tua routes
Breadcrumbs::for('orangtua.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('orangtua.index'));
});

Breadcrumbs::for('orangtua.kehadiran-siswa', function (BreadcrumbTrail $trail) {
    $trail->parent('orangtua.index');

    $trail->push('Kehadiran Siswa', route('orangtua.kehadiran-siswa'));
});

Breadcrumbs::for('orangtua.progres-pembelajaran-siswa', function (BreadcrumbTrail $trail) {
    $trail->parent('orangtua.index');

    $trail->push('Progres Pembelajaran', route('orangtua.progres-pembelajaran-siswa'));
});

// guru routes
Breadcrumbs::for('guru.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('guru.index'));
});

Breadcrumbs::for('guru.presensi', function (BreadcrumbTrail $trail) {
    $trail->parent('guru.index');

    $trail->push('Presensi', route('guru.presensi'));
});


Breadcrumbs::for('guru.presensi-detail', function (BreadcrumbTrail $trail, $pertemuan) {
    $trail->parent('guru.presensi');

    $trail->push($pertemuan->id, route('guru.presensi-detail', $pertemuan));
});

Breadcrumbs::for('guru.progres-pembelajaran', function (BreadcrumbTrail $trail) {
    $trail->parent('guru.index');

    $trail->push('Progres Pembelajaran', route('guru.progres-pembelajaran'));
});


Breadcrumbs::for('guru.progres-pembelajaran.show', function (BreadcrumbTrail $trail, Subject $subject, Student $student) {
    $trail->parent('guru.progres-pembelajaran');

    $trail->push("{$student->user->name} | {$subject->name}", route('guru.progres-pembelajaran.show', [$subject, $student]));
});
