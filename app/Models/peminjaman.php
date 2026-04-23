<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    protected $table = 'peminjaman';
    
    protected $fillable = [
        'Buku_id',
        'Anggota_id',
        'Petugas_id',
        'Tanggal_peminjaman',
        'Tanggal_kembali',
    ];

    public function buku()
    {
        return $this->belongsTo(buku::class, 'Buku_id');
    }

    public function anggota()
    {
        return $this->belongsTo(anggota::class, 'Anggota_id');
    }

    public function petugas()
    {
        return $this->belongsTo(petugas::class, 'Petugas_id');
    }
}
