<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\dashboard\BukuRequest;

class BukuController extends Controller
{
    public function index()
    {
        $limit = 10;
        $bukus = Buku::orderBy('name', 'asc')->paginate($limit);
        $count = $bukus->count();
        $no = $limit * ($bukus->currentPage() - 1);

        return view('dashboard.buku.index', compact('bukus', 'no', 'limit', 'count'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('dashboard.buku.create', compact('kategoris'));
    }

    public function store(BukuRequest $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $buku = new Buku();
        $buku->name = $request->name;
        $buku->pengarang = $request->pengarang;
        $buku->penerbit = $request->penerbit;
        $buku->deskripsi = $request->deskripsi;
        $buku->kode_buku = $request->kode_buku;
        $buku->stok = $request->stok;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->kategoris_id = $request->kategoris_id;
        $buku->rak = $request->rak;

        if ($request->hasFile('image')) {
            $request->file('image')->move('storage/image/buku/', $request->file('image')->getClientOriginalName());
            $buku->image = $request->file('image')->getClientOriginalName();
        }

        $buku->save();

        return redirect()->route('dashboard.buku.index')->with('success', 'Berhasil Menambahkan Buku');
    }

    public function edit($id)
    {
        $kategoris = Kategori::all();
        $buku = Buku::where('id', $id)->firstOrFail();
        return view('dashboard.buku.edit', compact('buku','kategoris'));
    }

    public function update(BukuRequest $request, $id)
    {
        $buku = Buku::findOrFail($id);
        $buku->name = $request->name;
        $buku->pengarang = $request->pengarang;
        $buku->penerbit = $request->penerbit;
        $buku->deskripsi = $request->deskripsi;
        $buku->kode_buku = $request->kode_buku;
        $buku->stok = $request->stok;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->kategoris_id = $request->kategoris_id;
        $buku->rak = $request->rak;

        if ($request->hasFile('image')) {
            $request->file('image')->move('storage/image/buku/', $request->file('image')->getClientOriginalName());
            $buku->image = $request->file('image')->getClientOriginalName();
        }else{
            $buku->image = $buku->image;
        }

        $buku->save();

        return redirect()->route('dashboard.buku.index')->with('success', 'Berhasil Update Buku');
    }

    public function destroy($id)
    {
        $buku = Buku::where('id', $id)->firstOrFail();
        $buku->delete();
        return redirect()->route('dashboard.buku.index')->with('success', 'Berhasil Menghapus Buku');
    }
}
