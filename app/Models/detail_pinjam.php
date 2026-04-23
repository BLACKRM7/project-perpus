<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detail_pinjam extends Model
{
    protected $table = 'detail_pinjams';
    protected $fillable = [
        'Pinjam_id',
        'Buku_id',
        'Status_buku',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(peminjaman::class, 'Pinjam_id');
    }

    public function buku()
    {
        return $this->belongsTo(buku::class, 'Buku_id');
    }
}
