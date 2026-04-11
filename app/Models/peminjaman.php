<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $fillable = [
        'id_pinjam',
        'tanggal_pinjam',
        'tanggal_kembali',
        'id_anggota',
        'id_buku',
    ];

    public function anggota()
    {
        return $this->belongsTo(anggota::class, 'id_anggota');
    }

    public function buku()
    {
        return $this->belongsTo(buku::class, 'id_buku');
    }
}
