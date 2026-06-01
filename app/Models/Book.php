<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'room_id',
        'book_id',
        'book_name',
        'author',
        'publisher',
        'publication_year',
        'status',
    ];

    // Relasi ke room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // Relasi ke borrowing
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}