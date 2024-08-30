<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;

class AdminController extends Controller
{
    public function index()
    {

        $tahunAjaran = TahunAjaran::query()
            ->withCount([
                'classRooms',
                'classRoomStudents',
            ])
            ->where('mulai', '<=', now()->format('Y-m-d'))
            ->where('selesai', '>=', now()->format('Y-m-d'))
            ->first();

        // get name 5 latest tahun ajaran
        $latestTahunAjaran = TahunAjaran::query()
            ->withCount([
                'classRooms',
                'classRoomStudents',
            ])
            ->orderBy('mulai', 'asc')
            ->limit(10)
            ->get();


        return view('admin.index', compact(['tahunAjaran', 'latestTahunAjaran']));
    }
}
