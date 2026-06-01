<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Room;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::with('books')->get();

        return view('pages.admin.books.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::all();
        return view('pages.admin.books.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'book_id' => 'required|string|max:255|unique:books,book_id',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1000|max:' . (date('Y') + 1),
            'book_name' => 'required|string|max:255',
            'status' => 'required|in:available,unavailable,maintenance',
        ]);

        Book::create([
            'room_id' => $request->room_id,
            'book_id' => $request->book_id,
            'book_name' => $request->book_name,
            'status' => $request->status,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'publication_year' => $request->publication_year,
        ]);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Data Buku berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $rooms = Room::all();

        return view('pages.admin.books.edit', compact('book', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'book_id' => 'required|string|max:255|unique:books,book_id,' . $id,
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1000|max:' . (date('Y') + 1),
            'book_name' => 'required|string|max:255',
            'status' => 'required|in:available,unavailable,maintenance',
        ]);

        $book = Book::findOrFail($id);
        $book->update([
            'room_id' => $request->room_id,
            'book_id' => $request->book_id,
            'book_name' => $request->book_name,
            'status' => $request->status,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'publication_year' => $request->publication_year,
        ]);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Data Buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Data Buku berhasil dihapus');
    }
}
