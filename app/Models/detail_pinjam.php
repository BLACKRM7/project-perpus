<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detail_pinjam extends Model
{
    protected $table = 'detail_pinjam';
    protected $primaryKey = 'id_detail';
    protected $fillable = [
        'id_detail',
        'id_pinjam',
        'id_buku',
        'status_buku',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(peminjaman::class, 'id_pinjam');
    }

    public function buku()
    {
        return $this->belongsTo(buku::class, 'id_buku');
    }
}
