<?php

namespace App\Http\Controllers\User\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatKehadiran extends Controller
{
    public function index()
    {
        return view('user.siswa.riwayat-kehadiran');
    }
}
