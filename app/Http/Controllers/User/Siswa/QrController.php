<?php

namespace App\Http\Controllers\User\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Models\PertemuanStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QrController extends Controller
{
    public function index()
    {
        return view('user.siswa.scan-qr');
    }
    public function store(Request $request)
    {



        try {
            $request->validate([
                'code' => 'required|exists:pertemuans,code'
            ]);
            $pertemuan = Pertemuan::where('code', $request->code)->first();

            if ($pertemuan == null) {
                return response()->json([
                    'message' => 'Pertemuan tidak ditemukan'
                ]);
            }

            if ($pertemuan->tanggal->toDateString() != now()->toDateString()) {
                return response()->json([
                    'message' => 'Pertemuan tidak berlaku hari ini'
                ]);
            }

            if ($pertemuan->waktu_mulai > now()->toTimeString()) {
                return response()->json([
                    'message' => 'Pertemuan belum dimulai'
                ]);
            }

            $studentId = Auth::user()->student->id;

            $pertemuanStudent = PertemuanStudent::where('pertemuan_id', $pertemuan->id)
                ->where('student_id', $studentId)
                ->first();

            if ($pertemuanStudent == null) {
                return response()->json([
                    'message' => 'Anda tidak terdaftar di pertemuan ini'
                ]);
            }

            // check if student already absen
            if ($pertemuanStudent->pertemuan_status_id != 2) {
                return response()->json([
                    'message' => 'Anda sudah absen',
                    'status' => $pertemuanStudent->pertemuanStatus->name
                ]);
            }

            // get time now
            $timeNow = now();

            // get status hadir or terlambat from compare pertemuan waktu_mulai and waktu_selesai
            $status = $timeNow->between(
                $pertemuan->waktu_mulai,
                $pertemuan->waktu_selesai
            ) ? 1 : 4;

            $pertemuanStudent->update([
                'jam_masuk' => $timeNow,
                'pertemuan_status_id' => $status
            ]);

            return response()->json([
                'message' => 'Anda Berhasil Absen',
                'status' => $pertemuanStudent->pertemuanStatus->name
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal absen'
            ]);
        }
    }
}
