<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Models\Peminjaman;

class LaporanController extends Controller
{
    public function index()
    {
        return view('dashboard.laporan.index');
    }

    public function unduh(Request $request)
    {
        $request->validate([
            'month_start' => 'required|date_format:Y-m',
            'month_end' => 'required|date_format:Y-m',
        ]);

        $start = $request->input('month_start');
        $end = $request->input('month_end');

        $peminjaman = Peminjaman::with('member','buku')
                                ->whereBetween(\DB::raw('DATE_FORMAT(tgl_pinjam, "%Y-%m")'), [$start, $end])
                                ->get();

        return view('dashboard.laporan.unduh', compact('peminjaman', 'start', 'end'));
        // $pdf = new Dompdf();
        // $pdf->loadHtml(view('dashboard.laporan.unduh', compact('peminjaman', 'month')));


        // $pdf->setPaper('A4', 'landscape');

        // $pdf->render();

        // // Stream download as PDF file with a specific filename
        // return $pdf->stream('Laporan Peminjaman ' . $month . '.pdf');
    }
}

