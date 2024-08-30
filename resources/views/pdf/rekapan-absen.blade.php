<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type"
          content="text/html; charset=utf-8" />
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Nilai Siswa</title>
    <style>
        font-family: Arial,
        sans-serif;

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Rekapan Absen {{ $tahunAjaranName }}</h2>
    <p>Kelas: {{ $classRoomName }}</p>
    <p>Mata Pelajaran: {{ $subjectName }}</p>
    <p>Guru: {{ $pertemuan->materi->subject?->teacher->user->name ?? '-' }}</p>
    <p>Materi: {{ $pertemuan->materi->name }}</p>
    <p>Tanggal: {{ $pertemuan->tanggal->isoFormat('DD-MM-Y') }}</p>

    <p>Waktu: {{ $pertemuan->waktu_mulai }} - {{ $pertemuan->waktu_selesai }}</p>

    <br>
    <table>
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Waktu Waktu Kehadiran</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($pertemuanStudents as $pertemuanStudent)
                <tr>
                    <td>{{ $pertemuanStudent->student->user->name }}</td>
                    <td> {{ $pertemuanStudent->jam_masuk ?? '-' }}</td>
                    <td> {{ $pertemuanStudent?->pertemuanStatus?->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Tidak ada data</td>
                </tr>
            @endforelse

        </tbody>
    </table>
    <br>
</body>

</html>

