<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        // cek apakah user sudah login
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login');

        // return view('welcome');
    }
}
