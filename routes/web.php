<?php

use App\Models\Buku;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;

Route::get('/', function () { return view('welcome'); })->name('landing.index');
Route::get('/buku', function () {
    $bukus = Buku::all();
    if(request()->has('search')) {
        $bukus = Buku::where('name', 'like', '%' . request('search') . '%')->get();
    }
    return view('buku.index', compact('bukus'));
})->name('buku.index');
Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/', DashboardController::class)->name('dashboard');


    Route::resource('buku', BukuController::class, ['names' => 'dashboard.buku']);
    Route::resource('kategori', KategoriController::class, ['names' => 'dashboard.kategori']);
    Route::resource('member', MemberController::class, ['names' => 'dashboard.member']);
    Route::resource('users', AdminController::class, ['names' => 'dashboard.admin'])->except('create');

    Route::resource('peminjaman', PeminjamanController::class, ['names' => 'dashboard.peminjaman']);
    Route::get('/peminjamans/detailBuku/', [PeminjamanController::class, 'detailBuku'])->name('peminjaman.detailBuku');
    Route::get('/peminjamans/searchBuku/', [PeminjamanController::class, 'searchBuku'])->name('dashboard.peminjaman.searchBuku');
    Route::get('/peminjamans/konfirmasi/{id}', [PeminjamanController::class, 'konfirmasi'])->name('dashboard.peminjaman.konfirmasi');


    //denda
    Route::resource('denda', DendaController::class, ['names' => 'dashboard.denda']);
    Route::get('/dendas/konfirmasi/{id}', [DendaController::class, 'konfirmasi'])->name('dashboard.denda.konfirmasi');
    // pengembalian
    Route::resource('pengembalian', PengembalianController::class, ['names' => 'dashboard.pengembalian']);
    Route::get('/pengembalians/kembalikan/{id}', [PengembalianController::class, 'pengembalian'])->name('dashboard.pengembalian.pengembalian');
    Route::get('/pengembalians/konfirmasi/{id}', [PengembalianController::class, 'konfirmasi'])->name('dashboard.pengembalian.konfirmasi');

    //laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('dashboard.laporan.index');
    Route::post('/laporan/unduh', [LaporanController::class, 'unduh'])->name('dashboard.laporan.unduh');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
