<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\dashboard\kategoriRequest;

class KategoriController extends Controller
{
    public function index()
    {
        $limit = 10;
        $kategoris = Kategori::orderBy('name', 'asc')->paginate($limit);
        $count = $kategoris->count();
        $no = $limit * ($kategoris->currentPage() - 1);

        return view('dashboard.kategori.index', compact('kategoris', 'no', 'limit', 'count'));
    }

    public function create()
    {
        return view('dashboard.kategori.create');
    }

    public function store(kategoriRequest $request)
    {
        $kategori = new Kategori();
        $kategori->name = $request->name;
        $kategori->save();

        return redirect()->route('dashboard.kategori.index')->with('success', 'Berhasil Menambahkan Kategori');
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return view('dashboard.kategori.edit', compact('kategori'));
    }

    public function update(kategoriRequest $request, $id)
    {
        $kategori = Kategori::where('id', $id)->firstOrFail();
        $kategori->name = $request->name;
        $kategori->update();

        return redirect()->route('dashboard.kategori.index')->with('success', 'Berhasil Update Kategori');
    }

    public function destroy($id)
    {
        $kategori = Kategori::where('id', $id)->firstOrFail();
        $kategori->delete();
        return redirect()->route('dashboard.kategori.index')->with('success', 'Berhasil Menghapus Kategori');
    }
}
