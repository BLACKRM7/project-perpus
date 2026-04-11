<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class anggota extends Model
{
    protected $table = 'anggota';
    protected $primaryKey = 'id_anggota';
    protected $fillable = [
        'id_anggota',
        'nama',
        'alamat',
        'no_telp',
        'email',
        'tanggal_bergabung',
    ];

    public function peminjaman()
    {
        return $this->hasMany(peminjaman::class, 'id_anggota');
    }
}
