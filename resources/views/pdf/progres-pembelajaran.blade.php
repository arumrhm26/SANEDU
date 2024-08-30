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

        th:nth-child(1),
        td:nth-child(1) {
            width: 5%;
        }
    </style>
</head>

<body>
    <h2>Daftar Nilai Siswa {{ $materi?->subject?->classRoom?->tahunAjaran->name }}</h2>

    <p>Nama Siswa: {{ $studentName }}</p>
    <p>Kelas: {{ $materi?->subject?->classRoom?->full_name }}</p>
    <p>Mata Pelajaran: {{ $materi?->subject?->name }}</p>
    <p>Guru: {{ $materi?->subject?->teacher?->user->name }}</p>
    <p>Materi: {{ $materi?->name }}</p>
    <br>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Indikator</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($studentIndikators as $studentIndikator)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $studentIndikator->indikator->name }}</td>
                    <td>{{ $studentIndikator->nilai }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Tidak ada data</td>
                </tr>
            @endforelse

            @if ($studentIndikators->count() > 0)
                <tr>
                    <td colspan="2">Rata-rata</td>
                    <td>{{ $studentIndikators->avg('nilai') }}</td>
                </tr>
            @endif

        </tbody>
    </table>
    <br>
</body>

</html>
