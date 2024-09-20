<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type"
          content="text/html; charset=utf-8" />
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Nilai Siswa</title>
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
        <h2 style="">Rekap Perkembangan Belajar Siswa</h2>
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
                Materi
            </td>
            <td>
                : {{ $materi?->name ?? '-' }}
            </td>
        </tr>
        <tr>
            <td>
                Tentor
            </td>
            <td>
                : {{ $materi?->subject?->teacher?->user->name ?? '-' }}
            </td>
        </tr>

    </table>

    <table class="table">
        <thead>
            <tr>
                <th>Nama Siswa</th>
                @forelse ($indikators as $indikator)
                    <th>{{ $indikator->name }}</th>
                    @if ($loop->last)
                        <th>Rata-Rata</th>
                    @endif
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
                        @if ($loop->last)
                            <td>
                                @php
                                    $studentIndikators = $student->studentIndikators->whereIn(
                                        'indikator_id',
                                        $indikators->pluck('id'),
                                    );
                                    $rataRata = $studentIndikators->avg('nilai');
                                @endphp
                                {{ $rataRata }}
                            </td>
                        @endif
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

