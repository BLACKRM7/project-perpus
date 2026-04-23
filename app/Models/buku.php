<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    protected $table = 'buku';
    protected $fillable = [
        'Buku_id',
        'Judul',
        'Pengarang',
        'Penerbit',
        'Tahun_terbit',
        'Stok',
    ];

    public function peminjaman()
    {
        return $this->hasMany(detail_pinjam::class, 'Buku_id');
    }
}
