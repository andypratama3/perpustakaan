<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Buku;
use App\Models\Member;
use App\Models\Peminjaman;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\dashboard\PeminjamanRequest;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $limit = 10;

        $peminjamans = Peminjaman::orderBy('id', 'desc')->paginate($limit);

        if(Auth::user()->role != 'admin') {
            $member_id = Member::where('user_id', Auth::user()->id)->first()->id;
            $peminjamans = Peminjaman::where('members_id', $member_id)->orderBy('id', 'desc')->paginate($limit);
        }

        if($request->search != null) {
            $peminjamans->scopeFilter($request->search);
        }
        $count = $peminjamans->count();
        $no = $limit * ($peminjamans->currentPage() - 1);

        return view('dashboard.transaksi.peminjaman.index', compact('peminjamans', 'no', 'count'));
    }

    public function create(Request $request)
    {
        if(Auth::user()->role != 'admin') {
            $users = Member::where('user_id', Auth::user()->id)->get();
        }else {
            $users = Member::all();
        }

        $bukus = Buku::orderBy('name')->take(5)->get();
        if($request->search) {
            $bukus = Buku::where('name', 'like', '%'.$request->search.'%')->take(5)->get();
        }

        return view('dashboard.transaksi.peminjaman.create', compact('users','bukus'));
    }

    public function store(PeminjamanRequest $request)
    {
        if($request->members_id)
        {
            $members_id = $request->members_id;
        }else {
            $members_id = Member::where('user_id', Auth::user()->id)->first()->id;
        }

        $peminjaman = Peminjaman::create([
            'no_peminjaman' => Str::random(10),
            'members_id' => $members_id,
            'bukus_id' => $request->bukus_id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'jumlah' => $request->jumlah,
        ]);

        $buku = Buku::find($request->bukus_id);
        $buku->decrement('stok', $request->jumlah);

        return redirect()->route('dashboard.peminjaman.index')->with('success', 'Berhasil Menambahkan Peminjaman');
    }

    public function show(Peminjaman $peminjaman)
    {
         // Get the dates from $peminjaman object
        $tgl_pinjam = new DateTime($peminjaman->tgl_pinjam);
        $tgl_kembali = new DateTime($peminjaman->tgl_kembali);

        // Calculate the difference
        $diff = $tgl_pinjam->diff($tgl_kembali);

        // Access the difference in days
        $count = $diff->days;

        // Debug the count (optional)
        // dd($count);
        return view('dashboard.transaksi.peminjaman.show', compact('peminjaman', 'count'));
    }

    public function detailBuku(Request $request)
    {
        $buku = Buku::findOrFail($request->id);

        return response()->json([
            'name' => $buku->name,
            'pengarang' => $buku->pengarang,
            'penerbit' => $buku->penerbit,
            'tahun_terbit' => $buku->tahun_terbit,
            'stok' => $buku->stok,
        ]);
    }

    public function searchBuku(Request $request)
    {
        $bukus = Buku::where('name', 'like', '%'.$request->search.'%')->take(5)->get();

        return response()->json($bukus);
    }

}
