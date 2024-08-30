<?php

namespace App\Http\Controllers\User\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgresPembelajaran extends Controller
{
    public function index()
    {
        return view('user.siswa.progres-pembelajaran');
    }
}
