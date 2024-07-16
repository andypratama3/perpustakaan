<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\Member;
use App\Models\Peminjaman;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\dashboard\PeminjamanRequest;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->scopeFilter = new Peminjaman();
    }

    public function index(Request $request)
    {
        $limit = 10;
        $query = Peminjaman::orderBy('id', 'desc');

        // Check if search parameter is provided
        if ($request->search != null) {
            // Filter based on search parameter
            $query->filter(['search' => $request->search]);

            // If user is not admin, filter further by member_id
            if (Auth::user()->role != 'admin') {
                $member_id = Member::where('user_id', Auth::user()->id)->value('id');
                $query->where('members_id', $member_id);
            }
        } else {
            // Show all data when role admin
            if (Auth::user()->role != 'admin') {
                $member_id = Member::where('user_id', Auth::user()->id)->value('id');
                $query->where('members_id', $member_id);
            }
        }

        // Check if there are any peminjaman with unpaid denda
        $hasUnpaidDenda = false;
        if (isset($member_id)) {
            $hasUnpaidDenda = Denda::where('members_id', $member_id)->where('status', 'unpaid')->exists();
        }

        // Get the list of peminjamans
        $peminjamans = $query->paginate($limit);
        $count = $peminjamans->count();
        $no = $limit * ($peminjamans->currentPage() - 1);

        return view('dashboard.transaksi.peminjaman.index', compact('no', 'count', 'peminjamans', 'hasUnpaidDenda'));
    }


    public function create(Request $request)
    {
        if (Auth::user()->role != 'admin') {
            $users = Member::where('user_id', Auth::user()->id)->get();
        } else {
            $users = Member::all();
        }

        $bukus = Buku::orderBy('name')->take(5)->get();
        if ($request->search) {
            $bukus = Buku::where('name', 'like', '%' . $request->search . '%')->take(5)->get();
        }

        // Check if there are any unpaid dendas associated with peminjaman or members_id
        $hasUnpaidDenda = false;
        if (Auth::user()->role != 'admin') {
            $member_id = Member::where('user_id', Auth::user()->id)->value('id');
            $hasUnpaidDenda = Denda::whereHas('peminjaman', function ($query) use ($member_id) {
                $query->where('members_id', $member_id)->where('status', 'unpaid');
            })->exists();
        }

        return view('dashboard.transaksi.peminjaman.create', compact('users', 'bukus', 'hasUnpaidDenda'));
    }

    public function store(PeminjamanRequest $request)
    {
        if ($request->members_id) {
            $members_id = $request->members_id;
        } else {
            $members_id = Member::where('user_id', Auth::user()->id)->first()->id;
        }

        $peminjaman = Peminjaman::create([
            'no_peminjaman' => rand(),
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

        return view('dashboard.transaksi.peminjaman.show', compact('peminjaman', 'count'));
    }

    public function edit(Peminjaman $peminjaman, Request $request)
    {
        if (Auth::user()->role != 'admin') {
            $users = Member::where('user_id', Auth::user()->id)->get();
        } else {
            $users = Member::all();
        }

        $bukus = Buku::orderBy('name')->take(5)->get();
        if ($request->search) {
            $bukus = Buku::where('name', 'like', '%' . $request->search . '%')->take(5)->get();
        }

        return view('dashboard.transaksi.peminjaman.edit', compact('peminjaman', 'users', 'bukus'));
    }

    public function update(PeminjamanRequest $request, Peminjaman $peminjaman)
    {
        if ($request->members_id) {
            $members_id = $request->members_id;
        } else {
            $members_id = Member::where('user_id', Auth::user()->id)->first()->id;
        }

        $peminjaman->update([
            'no_peminjaman' => $peminjaman->no_peminjaman,
            'members_id' => $members_id,
            'bukus_id' => $request->bukus_id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'jumlah' => $request->jumlah,
        ]);

        $buku = Buku::find($request->bukus_id);
        if ($request->jumlah != $peminjaman->jumlah) {
            $buku->increment('stok', $peminjaman->jumlah - $request->jumlah);
        }

        $buku->decrement('stok', $request->jumlah);

        return redirect()->route('dashboard.peminjaman.index')->with('success', 'Berhasil Mengubah Peminjaman');
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
        $bukus = Buku::where('name', 'like', '%' . $request->search . '%')->take(5)->get();

        return response()->json($bukus);
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect()->route('dashboard.peminjaman.index')->with('success', 'Berhasil Menghapus Peminjaman');
    }

    public function konfirmasi($id)
    {
        $peminjaman = Peminjaman::find($id);
        if ($peminjaman->status == 'pending') {
            $peminjaman->status = 'konfirmasi';
        } else {
            $peminjaman->status = 'pending';
        }
        $peminjaman->update();

        return redirect()->route('dashboard.peminjaman.index')->with('success', 'Berhasil Mengkonfirmasi Peminjaman');
    }
}
