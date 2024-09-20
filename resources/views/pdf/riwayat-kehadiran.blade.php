<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type"
          content="text/html; charset=utf-8" />
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kehadiran</title>
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table>thead>tr>th {
            padding: 4px;
            text-align: center;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table>tbody>tr>td {
            padding: 4px;
            text-align: left;
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <div style="margin-bottom: 50px">
        <div style="width: 100px; height: 100px; float: left;">
            <img src="{{ public_path('logo.png') }}"
                 alt="logo"
                 width="100">
        </div>
        <h2 style="">Rekap Kehadiran Siswa</h2>
    </div>

    <table style="width: 100%; margin-bottom: 20px;">
        <tr>
            <td>
                Nama
            </td>
            <td>
                : {{ $studentName }}
            </td>
        </tr>
        <tr>
            <td>
                Kelas
            </td>
            <td>
                : {{ $classRoomStudent?->classRoom?->full_name }}
            </td>
        </tr>
        <tr>
            <td>
                Tahun Ajaran
            </td>
            <td>
                : {{ $classRoomStudent?->classRoom?->tahunAjaran?->name }}
            </td>
        </tr>

    </table>

    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Waktu Masuk</th>
                <th>Mata Pelajaran</th>
                <th>Materi</th>
                <th>Tentor</th>
                <th>Waktu Kehadiran</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($pertemuanStudents as $pertemuanStudent)
                <tr>
                    <td>{{ $pertemuanStudent?->pertemuan?->tanggal->isoFormat('D-MM-Y') }}</td>
                    <td>{{ $pertemuanStudent?->pertemuan?->waktu_mulai }}</td>
                    <td>{{ $pertemuanStudent?->pertemuan?->materi?->subject?->name }}</td>
                    <td>{{ $pertemuanStudent?->pertemuan?->materi?->name }}</td>
                    <td>{{ $pertemuanStudent?->pertemuan?->materi?->subject?->teacher?->user?->name }}</td>
                    <td> {{ $pertemuanStudent?->jam_masuk ?? '-' }}</td>
                    <td> {{ $pertemuanStudent?->pertemuanStatus?->name ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Data tidak ditemukan</td>
                </tr>
            @endforelse

        </tbody>
    </table>
</body>

</html>

