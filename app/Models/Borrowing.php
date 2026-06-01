<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_date',
        'status',
        'purpose',
        'identity_photo',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Relasi ke return
    public function returnData()
    {
        return $this->hasOne(ReturnModel::class);
    }
}