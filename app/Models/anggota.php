<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class anggota extends Model
{
    protected $table = 'anggota';
    protected $fillable = [
        'Nama',
        'Alamat',
        'No_Telp',
        'Email',
        'Tanggal_Bergabung',
    ];

    public function peminjaman()
    {
        return $this->hasMany(peminjaman::class, 'Anggota_id');
    }
}
