<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class petugas extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'petugas_id';
    protected $fillable = [
        'petugas_id',
        'nama_petugas',
        'username',
        'password',
    ];
}
