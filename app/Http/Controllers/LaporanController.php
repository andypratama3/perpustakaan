<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{

    public function index()
    {
        return view('dashboard.laporan.index');
    }

    public function unduh()
    {
        
    }

}
