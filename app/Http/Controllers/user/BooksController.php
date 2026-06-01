<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Room;

class BooksController extends Controller
{
    public function index()
    {
        $rooms = Room::with(['books' => function ($q) {
            $q->where('status', 'available');
        }])->get();
        return view('pages.user.books.index', compact('rooms'));
    }

    public function show($id)
    {
        $book = Book::with('room')->findOrFail($id);
        return view('pages.user.books.show', compact('book'));
    }
}
