<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DendaController extends Controller
{
    public function index(Request $request)
    {
        $limit = 10;
        $query = Denda::orderBy('id', 'desc');

        // Check if search parameter is provided
        if ($request->search != null) {
            // Filter based on search parameter
            $query->filter(['search' => $request->search]);

            // If user is not admin, filter further by member_id
            if (Auth::user()->role != 'admin') {
                $member_id = Member::where('user_id', Auth::user()->id)->first()->id;
                $peminjaman = Peminjaman::where('members_id', $member_id)->first()->id;
                // $query->where('peminjamans_id', $peminjaman->id);
                $query = $query->where('peminjamans_id', $peminjaman);

            }
        } else {
            //show all data when role admin
            if (Auth::user()->role == 'admin') {
                $query = $query;
            } else {
                $member_id = Member::where('user_id', Auth::user()->id)->first()->id;
                $peminjaman = Peminjaman::where('members_id', $member_id)->first()->id;
                $query = $query->where('peminjamans_id', $peminjaman->id);
            }
        }

        // Paginate the results
        $peminjamans = $query->paginate($limit);

        $count = $peminjamans->count();
        $no = $limit * ($peminjamans->currentPage() - 1);

        return view('dashboard.transaksi.denda.index', compact('peminjamans', 'no', 'count'));
    }
}
