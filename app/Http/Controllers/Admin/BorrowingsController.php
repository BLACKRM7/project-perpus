<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class BorrowingsController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book.room'])->latest()->paginate(5);
        return view('pages.admin.borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->get();
        $books = Book::where('status', 'available')->with('room')->get();
        return view('pages.admin.borrowings.create', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'book_id'          => 'required|exists:books,id',
            'borrow_date'    => 'required|date',
            'return_date'    => 'nullable|date|after_or_equal:borrow_date',
            'purpose'        => 'nullable|string',
            'identity_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status'         => 'required|in:pending,approved,returned,rejected',
        ]);

        $photoPath = $request->file('identity_photo')->store('identity_photos', 'public');

        Borrowing::create([
            'user_id'        => $request->user_id,
            'book_id'          => $request->book_id,
            'borrow_date'    => $request->borrow_date,
            'return_date'    => $request->return_date,
            'purpose'        => $request->purpose,
            'identity_photo' => $photoPath,
            'status'         => $request->status,
        ]);

        if ($request->status === 'approved') {
            Book::findOrFail($request->book_id)->update(['status' => 'unavailable']);
        }

        return redirect()->route('admin.borrowings.index')
            ->with('success', 'Data peminjaman berhasil ditambahkan.');
    }

    public function show($id)
    {
        $borrowing = Borrowing::with(['user', 'book.room', 'returnData'])->findOrFail($id);
        return view('pages.admin.borrowings.show', compact('borrowing'));
    }

    public function edit($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $users     = User::where('role', 'user')->get();
        $books     = Book::with('room')->get();
        return view('pages.admin.borrowings.edit', compact('borrowing', 'users', 'books'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'book_id'          => 'required|exists:books,id',
            'borrow_date'    => 'required|date',
            'return_date'    => 'nullable|date|after_or_equal:borrow_date',
            'purpose'        => 'nullable|string',
            'identity_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'         => 'required|in:pending,approved,returned,rejected',
        ]);

        $borrowing = Borrowing::findOrFail($id);
        $oldStatus = $borrowing->status;

        $data = $request->only(['user_id', 'book_id', 'borrow_date', 'return_date', 'purpose', 'status']);

        // Handle photo replacement
        if ($request->hasFile('identity_photo')) {
            if ($borrowing->identity_photo) {
                Storage::disk('public')->delete($borrowing->identity_photo);
            }
            $data['identity_photo'] = $request->file('identity_photo')->store('identity_photos', 'public');
        }

        $borrowing->update($data);

        // Sync Book status
        $book = Book::findOrFail($request->book_id);
        if ($request->status === 'approved') {
            $book->update(['status' => 'unavailable']);
        } elseif (in_array($request->status, ['returned', 'rejected'])) {
            $book->update(['status' => 'available']);
        }

        return redirect()->route('admin.borrowings.index')
            ->with('success', 'Data peminjaman berhasil diupdate.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,returned,rejected',
        ]);

        $borrowing = Borrowing::findOrFail($id);
        $oldStatus = $borrowing->status;
        $newStatus = $request->status;

        $borrowing->update(['status' => $newStatus]);

        $book = Book::findOrFail($borrowing->book_id);
        if ($newStatus === 'approved' && $oldStatus !== 'approved') {
            $book->update(['status' => 'unavailable']);
        } elseif (in_array($newStatus, ['returned', 'rejected']) && $oldStatus === 'approved') {
            $book->update(['status' => 'available']);
        }

        return redirect()->back()->with('success', 'Status peminjaman berhasil diupdate.');
    }

    public function destroy($id)
    {
        $borrowing = Borrowing::findOrFail($id);

        if ($borrowing->identity_photo) {
            Storage::disk('public')->delete($borrowing->identity_photo);
        }
        if ($borrowing->status === 'approved') {
            Book::find($borrowing->book_id)?->update(['status' => 'available']);
        }

        $borrowing->delete();
        return redirect()->route('admin.borrowings.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
