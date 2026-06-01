<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BorrowingsController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::where('user_id', Auth::id())
            ->with(['book.room', 'returnData'])
            ->latest()
            ->paginate(5);
        return view('pages.user.borrowings.index', compact('borrowings'));
    }

    public function create($book_id)
    {
        $book = Book::with('room')->findOrFail($book_id);
        if ($book->status !== 'available') {
            return redirect()->route('user.books.index')
                ->with('error', 'Buku ini tidak tersedia untuk dipinjam.');
        }
        return view('pages.user.borrowings.create', compact('book'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id'        => 'required|exists:books,id',
            'borrow_date'    => 'required|date',
            'return_date'    => 'nullable|date|after_or_equal:borrow_date',
            'purpose'        => 'nullable|string|max:500',
            'identity_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoPath = $request->file('identity_photo')->store('identity_photos', 'public');

        Borrowing::create([
            'user_id'        => Auth::id(),
            'book_id'        => $request->book_id,
            'borrow_date'    => $request->borrow_date,
            'return_date'    => $request->return_date,
            'purpose'        => $request->purpose,
            'identity_photo' => $photoPath,
            'status'         => 'pending',
        ]);

        return redirect()->route('user.borrowings.index')
            ->with('success', 'Permintaan peminjaman berhasil dikirim. Menunggu persetujuan admin.');
    }

    public function show($id)
    {
        $borrowing = Borrowing::where('user_id', Auth::id())
            ->with(['book.room', 'returnData'])
            ->findOrFail($id);
        return view('pages.user.borrowings.show', compact('borrowing'));
    }

    public function destroy($id)
    {
        $borrowing = Borrowing::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);

        if ($borrowing->identity_photo) {
            Storage::disk('public')->delete($borrowing->identity_photo);
        }

        $borrowing->delete();
        return redirect()->route('user.borrowings.index')
            ->with('success', 'Peminjaman berhasil dibatalkan.');
    }
}
