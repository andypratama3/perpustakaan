<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Pengembalian;
use App\Models\Member;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        $limit = 10;
        $query = Pengembalian::query()->orderBy('id', 'desc');

        if ($request->search) {
            $query->where('no_peminjaman', 'like', '%' . $request->search . '%');

            if (Auth::user()->role != 'admin') {
                $member_id = Member::where('user_id', Auth::user()->id)->value('id');
                $query->whereHas('peminjaman', function ($query) use ($member_id) {
                    $query->where('members_id', $member_id);
                });
            }
        } else {
            if (Auth::user()->role == 'admin') {
                // do nothing
            } else {
                $member_id = Member::where('user_id', Auth::user()->id)->value('id');
                $query->whereHas('peminjaman', function ($query) use ($member_id) {
                    $query->where('members_id', $member_id);
                });
            }
        }

        $peminjamans = $query->paginate($limit);

        $no = $limit * ($peminjamans->currentPage() - 1);

        return view('dashboard.transaksi.pengembalian.index', compact('peminjamans', 'no'));
    }


    public function pengembalian($id)
    {
        $peminjaman = Peminjaman::find($id);

        $pengembalian = Pengembalian::where('no_peminjaman', $peminjaman->no_peminjaman)->first();

        $denda = Denda::where('no_peminjaman', $peminjaman->no_peminjaman)->first();
        $total_denda = 0;
        if(!$denda){

        }else{
            $total_denda = $denda->total_denda;
        }

        if(!$pengembalian){
            $pengembalian = new Pengembalian();
            $pengembalian->denda = $total_denda;
            $pengembalian->no_peminjaman = $peminjaman->no_peminjaman;
            $pengembalian->tgl_kembali = Carbon::now();
            $pengembalian->save();

        }else{
            $pengembalian->denda = $total_denda;
            $pengembalian->no_peminjaman = $peminjaman->no_peminjaman;
            $pengembalian->tgl_kembali = Carbon::now();
            $pengembalian->update();
        }

        return redirect()->route('dashboard.pengembalian.index')->with('success','Berhasil Di Kembalikan');
    }



    public function konfirmasi($id)
    {
        $pengembalian = Pengembalian::find($id);
        if($pengembalian->status == 'Dikembalikan'){
            $pengembalian->status = 'Konfirmasi';

        }else{
            $pengembalian->status = 'Dikembalikan';
        }
        $pengembalian->update();
        return redirect()->route('dashboard.pengembalian.index')->with('success','Berhasil Di Konfirmasi');
    }
}
