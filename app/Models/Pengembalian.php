<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalians';

    protected $fillable = [
        'no_peminjaman',
        'peminjamans_id',
        'tgl_kembali',
        'denda',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'no_peminjaman', 'no_peminjaman');
    }


}
