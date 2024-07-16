<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\Member;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // Count entities
        $buku = Buku::count();
        $members = Member::count();
        $peminjamans = Peminjaman::count();
        $dendas = Denda::count();
        $kategori = Kategori::count();

        // Count overdue fines
        
        // Get current date
        $today = Carbon::today();

        // Count new members created today
        $newMembers = Member::whereDate('created_at', $today)->count();

        // Count total peminjaman today
        $peminjamanToday = Peminjaman::whereDate('created_at', $today)->count();

        // Count total pengembalian today
        $pengembalianToday = Peminjaman::whereDate('tgl_kembali', $today)->where('status', 'konfirmasi')->count();

        // Count total jatuh tempo (overdue) today
        $jatuhTempoToday = Peminjaman::whereDate('tgl_kembali', '<', $today)->where('status', 'konfirmasi')->count();

        // Calculate date ranges for overdue fines and arrears
        $sevenDaysAgo = $today->copy()->subDays(7);
        $lastMonthStart = $today->copy()->startOfMonth()->subMonth()->format('Y-m-d');
        $lastMonthEnd = $today->copy()->startOfMonth()->subDay()->format('Y-m-d');

        // Total Pendapatan Denda in the last 7 days
        $totalDenda = Denda::whereDate('created_at', '>=', $sevenDaysAgo)->sum('total_denda');

        // Total Tunggakan from May 31, 2024, to July 16, 2024
        $totalTunggakan = Peminjaman::where('status', 'konfirmasi')
            ->whereDate('tgl_kembali', '<', $today)
            ->whereDate('tgl_kembali', '>=', '2024-05-31')
            ->sum('denda');

        // Format the amounts as Indonesian Rupiah
        $totalDendaFormatted = 'Rp' . number_format($totalDenda, 0, ',', '.');
        $totalTunggakanFormatted = 'Rp' . number_format($totalTunggakan, 0, ',', '.');

        // Calculate percentage change from last month
        $totalTunggakanLastMonth = Peminjaman::where('status', 'konfirmasi')
            ->whereDate('tgl_kembali', '<', $lastMonthEnd)
            ->whereDate('tgl_kembali', '>=', $lastMonthStart)
            ->sum('denda');

        $percentageChange = 0;
        if ($totalTunggakanLastMonth != 0) {
            $percentageChange = (($totalTunggakan - $totalTunggakanLastMonth) / $totalTunggakanLastMonth) * 100;
        }

        // Format percentage change
        $percentageChangeFormatted = number_format($percentageChange, 2) . '%';

        return view('dashboard.index', compact(
            'buku',
            'members',
            'peminjamans',
            'dendas',
            'kategori',
            'newMembers',
            'peminjamanToday',
            'pengembalianToday',
            'jatuhTempoToday',
            'totalDendaFormatted',
            'totalTunggakanFormatted',
            'percentageChangeFormatted'
        ));
    }
}
