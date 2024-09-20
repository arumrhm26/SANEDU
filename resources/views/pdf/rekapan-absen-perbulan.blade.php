<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type"
          content="text/html; charset=utf-8" />
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Rekapan Absen</title>
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
        <h2 style="">Rekap Absensi Siswa</h2>
    </div>

    <table style="width: 100%; margin-bottom: 20px;">
        <tr>
            <td>
                Kelas
            </td>
            <td>
                : {{ $classRoomName }}
            </td>
            <td>
                Mata Pelajaran
            </td>
            <td>
                : {{ $subjectName }}
            </td>
        </tr>
        <tr>
            <td>
                Tahun Ajaran
            </td>
            <td>
                : {{ $tahunAjaranName }}
            </td>
            <td>
                Tentor
            </td>
            <td>
                : {{ $subject?->teacher?->user?->name ?? '-' }}
            </td>
        </tr>
        <tr>
            <td>
                Bulan
            </td>
            <td>
                : {{ $bulan }}
            </td>
        </tr>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Waktu Masuk</th>
                <th>Materi</th>
                <th>Nama</th>
                <th>Waktu Kehadiran</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($materiPertemuans as $pertemuans)
                @forelse ($pertemuans as $pertemuan)
                    @forelse ($pertemuan->pertemuanStudents as $item)
                        <tr>

                            @if ($loop->first)
                                <td rowspan="{{ $pertemuan->pertemuanStudents->count() ?? 1 }}">
                                    {{ $pertemuan?->tanggal->isoFormat('DD-MM-Y') ?? '-' }}
                                </td>

                                <td rowspan="{{ $pertemuan->pertemuanStudents->count() ?? 1 }}">
                                    {{ $pertemuan?->waktu_mulai ?? '-' }}
                                    -
                                    {{ $pertemuan?->waktu_selesai ?? '-' }}
                                </td>

                                <td rowspan="{{ $pertemuan->pertemuanStudents->count() ?? 1 }}">
                                    {{ $pertemuan?->materi?->name ?? '-' }}
                                </td>
                            @endif
                            <td>{{ $item?->student?->user?->name ?? '-' }}</td>
                            <td>{{ $item?->jam_masuk ?? '-' }}</td>
                            <td>{{ $item?->pertemuanStatus?->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                @empty
                    <tr>
                        <td colspan="6">Data tidak ditemukan</td>
                    </tr>
                @endforelse
            @empty
                <tr>
                    <td colspan="6">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
