<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\Member;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // Count entities
        $buku = Buku::count();
        $members = Member::count();
        $dendas = Denda::count();
        $kategori = Kategori::count();

        // Initialize variables for non-admin specific counts
        $newMembers = null;
        $peminjamanToday = null;
        $pengembalianToday = null;
        $jatuhTempoToday = null;

        // Check if user is not admin
        if (Auth::user()->role != 'admin') {
            // Get current user's member ID
            $memberId = Auth::user()->member_id;

            // Count new members created today
            $newMembers = Member::whereDate('created_at', Carbon::today())->count();

            // Count total peminjaman today
            $peminjamanToday = Peminjaman::where('members_id', $memberId)
                ->whereDate('created_at', Carbon::today())
                ->count();

            // Count total pengembalian today
            $pengembalianToday = Peminjaman::where('members_id', $memberId)
                ->whereDate('tgl_kembali', Carbon::today())
                ->where('status', 'konfirmasi')
                ->count();

            // Count total jatuh tempo (overdue) today
            $jatuhTempoToday = Peminjaman::where('members_id', $memberId)
                ->whereDate('tgl_kembali', '<', Carbon::today())
                ->where('status', 'konfirmasi')
                ->count();

            // Fetch only peminjaman data associated with the current member
            $peminjamans = Peminjaman::where('members_id', $memberId)->count();

            // If you want to return null when there are no peminjaman records for the member
            // if ($peminjamans->isEmpty()) {
            //     return null;
            // }
        } else {
            // User is admin, fetch all peminjaman data
            $peminjamans = Peminjaman::count();
        }

        // Calculate date ranges for overdue fines and arrears
        $sevenDaysAgo = Carbon::today()->subDays(7);
        $lastMonthStart = Carbon::today()->startOfMonth()->subMonth()->format('Y-m-d');
        $lastMonthEnd = Carbon::today()->startOfMonth()->subDay()->format('Y-m-d');

        // Total Pendapatan Denda in the last 7 days
        $totalDenda = Denda::whereDate('created_at', '>=', $sevenDaysAgo)->sum('total_denda');

        // Total Tunggakan from May 31, 2024, to July 16, 2024
        $totalTunggakan = Peminjaman::where('status', 'konfirmasi')
            ->whereDate('tgl_kembali', '<', Carbon::today())
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
