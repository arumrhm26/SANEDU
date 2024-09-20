td
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
            text-align: left;
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
        <h2 style="">Nilai Perkembangan Belajar Siswa</h2>
    </div>

    <table style="width: 100%; margin-bottom: 20px;">
        <tr>
            <td>
                Nama
            </td>
            <td>
                : {{ $studentName }}
            </td>
            <td>
                Mata Pelajaran
            </td>
            <td>
                : {{ $subject?->name }}
            </td>
        </tr>
        <tr>
            <td>
                Kelas
            </td>
            <td>
                : {{ $subject?->classRoom?->full_name }}
            </td>
            <td>
                Tentor
            </td>
            <td>
                : {{ $subject?->teacher?->user?->name }}
            </td>
        </tr>
        <tr>
            <td>
                Tahun Ajaran
            </td>
            <td>
                : {{ $subject?->classRoom?->tahunAjaran?->name }}
            </td>
        </tr>

    </table>

    <table class="table">
        <thead>
            <tr>
                <th style="text-align: start; width: 10px">No</th>
                <th style="text-align: start">Materi</th>
                <th style="text-align: start">Indikator</th>
                <th style="text-align: start">Nilai</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($studentIndikators as $studentIndikator)
                @forelse ($studentIndikator as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        @if ($loop->first)
                            <td rowspan="{{ $item->indikator?->materi?->indikators->count() ?? 1 }}">
                                {{ $item->indikator?->materi?->name ?? '-' }}
                            </td>
                        @endif

                        <td>{{ $item->indikator?->name ?? '-' }}</td>
                        <td>{{ $item->nilai ?? '-' }}</td>
                    </tr>

                    {{-- Rata rata --}}
                    @if ($loop->last)
                        <tr>
                            <td colspan="3"
                                style="font-weight: bold">
                                Rata-rata
                            </td>

                            <td style="font-weight: bold">
                                {{ $studentIndikator->avg('nilai') }}
                            </td>
                        </tr>
                    @endif

                @empty
                    <tr>
                        <td colspan="4"
                            style="text-align: center; padding: 10px;">Data tidak ditemukan</td>
                    </tr>
                @endforelse
            @empty
                <tr>
                    <td colspan="4"
                        style="text-align: center; padding: 10px;">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>
</body>

</html>
