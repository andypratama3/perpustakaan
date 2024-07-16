<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Member;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DendaController extends Controller
{

    public function index(Request $request)
    {
        $limit = 10;

        // $peminjaman = Peminjaman::count();
        $query = Denda::orderBy('id', 'desc');

        // Check member id
        if (Auth::user()->role != 'admin') {
            $member_id = Member::where('user_id', Auth::user()->id)->first();
            $peminjaman = Peminjaman::where('members_id', $member_id)->first();
            $query->where('members_id', $member_id->id);
        }

        // Apply search filter
        if ($request->search) {
            $query->where('no_peminjaman', 'like', '%' . $request->search . '%');
        }

        // Paginate the results
        $peminjamans = $query->paginate($limit);

        $count = $peminjamans->count();
        $no = $limit * ($peminjamans->currentPage() - 1);

        return view('dashboard.transaksi.denda.index', compact('peminjamans', 'no', 'count'));
    }

    public function konfirmasi($id)
    {
        $denda = Denda::find($id);

        if($denda->status == 'paid') {
            $denda->status = 'unpaid';
        }else {
            $denda->status = 'paid';
        }
        $denda->save();

        return redirect()->route('dashboard.denda.index')->with('success','Denda Berhasil Di Update');
    }
}
