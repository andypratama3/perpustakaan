<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'dendas';

    protected $fillable = [
        'no_peminjaman',
        'peminjamans_id',
        'status',
        'total_denda',
        'lama_terlambat',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjamans_id', 'id');
    }
}
