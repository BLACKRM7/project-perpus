<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    protected $fillable = [
        'id_buku',
        'judul',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'stok',
    ];

    public function peminjaman()
    {
        return $this->hasMany(peminjaman::class, 'id_buku');
    }
}
