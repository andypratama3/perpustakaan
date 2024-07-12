<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'bukus';

    protected $fillable = [
        'name',
        'pengarang',
        'penerbit',
        'deskripsi',
        'kode_buku',
        'stok',
        'tahun_terbit',
        'image',
    ];

    /**
     * Get the kategori that owns the Buku
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategoris_id', 'id');
    }
}
