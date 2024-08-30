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
        }

        table,
        th,
        td {
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

        th:not(:first-child),
        td:not(:first-child) {
            width: 10%;
        }
    </style>
</head>

<body>
    <h2>Rekapan Progres</h2>
    <p>Tahun Ajaran: {{ $tahunAjaranName }}</p>
    <p>Kelas: {{ $classRoomName }}</p>
    <p>Guru: {{ $materi->subject?->teacher?->user->name ?? '-' }}</p>
    <p>Mata Pelajaran: {{ $subjectName }}</p>
    <p>Materi: {{ $materi->name }}</p>

    <br>
    <table>
        <thead>
            <tr>
                <th>Nama Siswa</th>
                @forelse ($indikators as $indikator)
                    <th>{{ $indikator->name }}</th>
                @empty
                    <th>Indikator</th>
                @endforelse
            </tr>
        </thead>
        <tbody>

            @forelse ($students as $student)
                <tr>
                    <td>{{ $student->user->name }}</td>
                    @forelse ($indikators as $indikator)
                        <td>
                            @php
                                $nilai =
                                    $student->studentIndikators->where('indikator_id', $indikator->id)->first()
                                        ->nilai ?? '-';
                            @endphp
                            {{ $nilai }}
                        </td>
                    @empty
                        <td>Indikator</td>
                    @endforelse
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $indikators->count() + 1 }}">Tidak ada data</td>
                </tr>
            @endforelse

        </tbody>
    </table>
    <br>
</body>

</html>

