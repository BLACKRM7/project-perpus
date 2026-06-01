<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReturnModel;
use App\Models\Borrowing;
use App\Models\Book;

class ReturnsController extends Controller
{
    public function index()
    {
        $returns = ReturnModel::with(['borrowing.user', 'borrowing.book.room'])->latest()->get();
        $returnedBorrowings = Borrowing::with(['user', 'book.room', 'returnData'])
            ->where('status', 'returned')
            ->doesntHave('returnData')
            ->latest()
            ->get();

        return view('pages.admin.returns.index', compact('returns', 'returnedBorrowings'));
    }

    public function show($id)
    {
        $return = ReturnModel::with(['borrowing.user', 'borrowing.book.room'])->findOrFail($id);
        return view('pages.admin.returns.show', compact('return'));
    }

    public function approve($id)
    {
        $return = ReturnModel::with('borrowing')->findOrFail($id);
        $return->borrowing->update(['status' => 'returned']);
        Book::find($return->borrowing->book_id)?->update(['status' => 'available']);
        return redirect()->route('admin.returns.index')->with('success', 'Pengembalian berhasil dikonfirmasi.');
    }

    public function reject($id)
    {
        $return = ReturnModel::with('borrowing')->findOrFail($id);
        $return->borrowing->update(['status' => 'approved']); // revert to approved
        $return->delete();
        return redirect()->route('admin.returns.index')->with('success', 'Pengembalian ditolak.');
    }

    public function destroy($id)
    {
        ReturnModel::findOrFail($id)->delete();
        return redirect()->route('admin.returns.index')->with('success', 'Data pengembalian berhasil dihapus.');
    }
}
