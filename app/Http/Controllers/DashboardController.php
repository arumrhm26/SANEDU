<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {

        return view('welcome');


        // make JSON data that is stored as an object array. Each element in the array will be treated as a row.
        // $json = [
        //     [
        //         'nickname' => 'Nick 1',
        //     ],
        //     [
        //         'nickname' => 'Nick 2',
        //     ]
        // ];


        // return response()->json($json);
    }
}
