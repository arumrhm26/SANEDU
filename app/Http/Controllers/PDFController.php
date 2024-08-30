<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\ClassRoomStudent;
use App\Models\Indikator;
use App\Models\Materi;
use App\Models\Pertemuan;
use App\Models\PertemuanStudent;
use App\Models\Student;
use App\Models\StudentIndikator;
use App\Models\Subject;
use App\Models\TahunAjaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function progresPembelajaran(Request $request, Materi $materi)
    {
        // check if logged in user is a student or parent
        if (Auth::user()->getRoleNames()->first() != 'siswa' && Auth::user()->getRoleNames()->first() != 'orangtua') {
            return redirect()->back();
        }

        $studentId = Auth::user()->getRoleNames()->first() == 'siswa' ? Auth::user()->student->id : Student::where('user_id', Auth::user()->studentParent->child->id)->first()->id;
        $studentName = Auth::user()->getRoleNames()->first() == 'siswa' ? Auth::user()->name : Auth::user()->studentParent->child->name;

        $studentIndikators = StudentIndikator::query()
            ->where('student_id', $studentId)
            ->whereHas('indikator.materi', function ($query) use ($materi) {
                $query->where('id', $materi->id);
            })
            ->get();

        $pdf = PDF::loadView('pdf.progres-pembelajaran', compact('studentIndikators', 'materi', 'studentId', 'studentName'));

        $name = $studentName . '_' . $materi->subject->name . $materi->name . '.pdf';

        return $pdf->download($name);
    }

    public function riwayatKehadiran(Request $request, TahunAjaran $tahunAjaran)
    {
        if (Auth::user()->getRoleNames()->first() != 'siswa' && Auth::user()->getRoleNames()->first() != 'orangtua') {
            return redirect()->back();
        }


        $studentId = Auth::user()->getRoleNames()->first() == 'siswa' ? Auth::user()->student->id : Student::where('user_id', Auth::user()->studentParent->child->id)->first()->id;
        $studentName = Auth::user()->getRoleNames()->first() == 'siswa' ? Auth::user()->name : Auth::user()->studentParent->child->name;

        $pertemuanStudents = PertemuanStudent::query()
            ->where('student_id', $studentId)
            ->whereHas('pertemuan.materi.subject.classRoom', function ($query) use ($tahunAjaran) {
                $query->where('tahun_ajaran_id', $tahunAjaran->id);
            })
            ->get();

        $classRoomStudent = ClassRoomStudent::where('student_id', $studentId)->where('tahun_ajaran_id', $tahunAjaran->id)->first();

        $pdf = PDF::loadView('pdf.riwayat-kehadiran', compact('pertemuanStudents', 'tahunAjaran', 'classRoomStudent', 'studentId', 'studentName'));

        $name = $studentName . '_' . $tahunAjaran->name . '.pdf';

        // clean name from special characters
        $name = str_replace('/', '-', $name);

        return $pdf->download($name);
    }

    public function rekapanAbsen(Request $request, Pertemuan $pertemuan)
    {

        $pertemuanStudents = PertemuanStudent::query()
            ->whereHas('pertemuan', function ($query) use ($pertemuan) {
                $query->where('id', $pertemuan->id);
            })
            ->get();

        $tahunAjaranName = TahunAjaran::find($pertemuan->materi->subject->classRoom->tahun_ajaran_id)->name;
        // replace "/" in tahun ajaran name
        $tahunAjaranName = str_replace('/', '-', $tahunAjaranName);
        $classRoomName = ClassRoom::find($pertemuan->materi->subject->classRoom->id)->full_name;
        $subjectName = Subject::find($pertemuan->materi->subject->id)->name;
        $materiName = Materi::find($pertemuan->materi->id)->name;

        $pdf = PDF::loadView('pdf.rekapan-absen', compact('pertemuanStudents', 'tahunAjaranName', 'pertemuan', 'classRoomName', 'subjectName', 'materiName'));

        $fileName = "{$tahunAjaranName}_{$classRoomName}_{$subjectName}_{$materiName}_{$pertemuan->tanggal->isoFormat('D-MM-Y')}.pdf";

        // clean name from special characters
        $name = str_replace('/', '-', $fileName);

        return $pdf->download($name);
    }

    public function rekapanProgres(Request $request, Materi $materi)
    {

        $studentIndikators = StudentIndikator::query()
            ->whereHas('indikator', function ($query) use ($materi) {
                $query->where('materi_id', $materi->id);
            })
            ->get();

        $indikators = Indikator::where('materi_id', $materi->id)->get();
        $students = $materi->subject->classRoom->students()->get();

        $tahunAjaranName = TahunAjaran::find($materi->subject->classRoom->tahun_ajaran_id)->name;
        // replace "/" in tahun ajaran name
        $tahunAjaranName = str_replace('/', '-', $tahunAjaranName);
        $classRoomName = ClassRoom::find($materi->subject->classRoom->id)->full_name;
        $subjectName = Subject::find($materi->subject->id)->name;
        $materiName = $materi->name;

        $pdf = PDF::loadView('pdf.rekapan-progres', compact('studentIndikators', 'materi', 'tahunAjaranName', 'classRoomName', 'subjectName', 'materiName', 'indikators', 'students'))->setPaper('a4', 'landscape');

        $fileName = "{$tahunAjaranName}_{$classRoomName}_{$subjectName}_{$materiName}.pdf";

        // clean name from special characters
        $name = str_replace('/', '-', $fileName);

        return $pdf->download($name);
    }

    public function rekapanProgresGuru(Request $request, Subject $subject)
    {
        $materis = Materi::query()
            ->where('subject_id', $subject->id)
            ->get();

        $tahunAjaranName = TahunAjaran::find($subject->classRoom->tahun_ajaran_id)->name;
        // replace "/" in tahun ajaran name
        $tahunAjaranName = str_replace('/', '-', $tahunAjaranName);
        $classRoomName = ClassRoom::find($subject->classRoom->id)->full_name;
        $subjectName = Subject::find($subject->id)->name;
        $students = $subject->classRoom->students()->get();


        foreach ($materis as $materi) {
            $indikators = Indikator::where('materi_id', $materi->id)->get();
            $studentIndikators = StudentIndikator::query()
                ->whereHas('indikator', function ($query) use ($materi) {
                    $query->where('materi_id', $materi->id);
                })
                ->get();

            $pdf = PDF::loadView('pdf.rekapan-progres', compact('studentIndikators', 'materi', 'tahunAjaranName', 'classRoomName', 'subjectName', 'indikators', 'students'))->setPaper('a4', 'landscape');

            $fileName = "{$tahunAjaranName}_{$classRoomName}_{$subjectName}_{$materi->name}.pdf";

            // clean name from special characters
            $name = str_replace('/', '-', $fileName);

            $pdf->save(storage_path("app/{$name}"));
        }

        $zip = new \ZipArchive();
        $zipFileName = "{$tahunAjaranName}_{$classRoomName}_{$subjectName}.zip";

        if ($zip->open(storage_path("app/{$zipFileName}"), \ZipArchive::CREATE) === TRUE) {
            foreach ($materis as $materi) {
                $fileName = "{$tahunAjaranName}_{$classRoomName}_{$subjectName}_{$materi->name}.pdf";
                $zip->addFile(storage_path("app/{$fileName}"), "{$materi->name}.pdf");
            }
            $zip->close();

            foreach ($materis as $materi) {
                $fileName = "{$tahunAjaranName}_{$classRoomName}_{$subjectName}_{$materi->name}.pdf";
                unlink(storage_path("app/{$fileName}"));
            }
        }

        return response()->download(storage_path("app/{$zipFileName}"))->deleteFileAfterSend(true);
    }
}
