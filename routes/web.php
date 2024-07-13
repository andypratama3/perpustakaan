<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', [LandingController::class, 'index'])->name('landing.index');

Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard');
    Route::resource('buku', BukuController::class, ['names' => 'dashboard.buku']);
    Route::resource('kategori', KategoriController::class, ['names' => 'dashboard.kategori']);
    Route::resource('member', MemberController::class, ['names' => 'dashboard.member']);
    Route::resource('users', AdminController::class, ['names' => 'dashboard.admin'])->except('create');

    Route::resource('peminjaman', PeminjamanController::class, ['names' => 'dashboard.peminjaman']);
    Route::get('/peminjamans/detailBuku/', [PeminjamanController::class, 'detailBuku'])->name('peminjaman.detailBuku');
    Route::get('/peminjamans/searchBuku/', [PeminjamanController::class, 'searchBuku'])->name('dashboard.peminjaman.searchBuku');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
