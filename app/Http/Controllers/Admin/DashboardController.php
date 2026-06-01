<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\ReturnModel;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index()
    {
        $totalUsers     = User::where('role', 'user')->count();
        $totalBooks     = Book::count();
        $availableBooks = Book::where('status', 'available')->count();
        $totalBorrowings  = Borrowing::count();
        $pendingBorrowings = Borrowing::where('status', 'pending')->count();
        $activeBorrowings = Borrowing::where('status', 'approved')->count();

        return view('pages.admin.dashboard', compact(
            'totalUsers', 'totalBooks', 'availableBooks', 'totalBorrowings', 'pendingBorrowings', 'activeBorrowings'
        ));
    }
}
