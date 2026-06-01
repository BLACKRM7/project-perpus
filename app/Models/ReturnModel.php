<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReturnModel extends Model
{
    use HasFactory;

    protected $table = 'returns';

    protected $fillable = [
        'borrowing_id',
        'returned_at',
        'condition_notes',
    ];

    // Relasi ke borrowing
    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }
}