<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'peminjamans';

    protected $fillable = [
        'no_peminjaman',
        'members_id',
        'bukus_id',
        'tgl_pinjam',
        'tgl_kembali',
        'denda',
        'jumlah',
        'total_pembayaran',
        'status',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('no_peminjaman', 'like', '%' . $search . '%')
                    ->orWhere('bukus_id', 'like', '%' . $search . '%')
                    ->orWhere('tgl_pinjam', 'like', '%' . $search . '%')
                    ->orWhere('tgl_kembali', 'like', '%' . $search . '%')
                    ->orWhere('denda', 'like', '%' . $search . '%')
                    ->orWhere('total_pembayaran', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%');
            });
        });
    }



    public function member()
    {
        return $this->belongsTo(Member::class, 'members_id');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class,'bukus_id');
    }

    public function denda()
    {
        return $this->hasOne(Denda::class, 'peminjamans_id');
    }
}
