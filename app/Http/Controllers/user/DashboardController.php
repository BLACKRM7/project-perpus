<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Book;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $activeBorrowings = Borrowing::where('user_id', $userId)
            ->whereIn('status', ['pending', 'approved'])
            ->with('book.room')
            ->latest()
            ->take(5)
            ->get();
        $totalBorrowings = Borrowing::where('user_id', $userId)->count();
        $availableBooks = Book::where('status', 'available')->count();
        return view('pages.user.dashboard', compact('activeBorrowings', 'totalBorrowings', 'availableBooks'));
    }
}
