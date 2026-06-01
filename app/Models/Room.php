<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Book;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_name',
        'location',
        'status',
    ];

    // Relasi ke PC
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}