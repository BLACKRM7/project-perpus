<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\BooksController;
use App\Http\Controllers\Admin\RoomsController;
use App\Http\Controllers\Admin\BorrowingsController;
use App\Http\Controllers\Admin\ReturnsController;

use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\BooksController as UserBooksController;
use App\Http\Controllers\User\BorrowingsController as UserBorrowingsController;
use App\Http\Controllers\User\ProfileController as UserProfileController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }
    return redirect()->route('login');
})->name('home');


/*
|--------------------------------------------------------------------------
| Guest Routes (Belum Login)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('post.login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('post.register');
});


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Users Management
        Route::resource('users', UsersController::class);

        // Books Management
        Route::resource('books', BooksController::class);

        // Rooms Management
        Route::resource('rooms', RoomsController::class);

        // Borrowings Management
        Route::resource('borrowings', BorrowingsController::class);
        Route::patch('borrowings/{id}/status', [BorrowingsController::class, 'updateStatus'])->name('borrowings.updateStatus');

        // Returns Management
        Route::resource('returns', ReturnsController::class)->only(['index', 'show', 'destroy']);
        Route::patch('returns/{id}/approve', [ReturnsController::class, 'approve'])->name('returns.approve');
        Route::patch('returns/{id}/reject', [ReturnsController::class, 'reject'])->name('returns.reject');
    });


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::prefix('user')
    ->middleware(['auth', 'user'])
    ->name('user.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

        // Browse Books
        Route::get('/books', [UserBooksController::class, 'index'])->name('books.index');
        Route::get('/books/{id}', [UserBooksController::class, 'show'])->name('books.show');

        // Borrowings
        Route::get('/borrowings', [UserBorrowingsController::class, 'index'])->name('borrowings.index');
        Route::get('/borrowings/create/{book_id}', [UserBorrowingsController::class, 'create'])->name('borrowings.create');
        Route::post('/borrowings', [UserBorrowingsController::class, 'store'])->name('borrowings.store');
        Route::get('/borrowings/{id}', [UserBorrowingsController::class, 'show'])->name('borrowings.show');
        Route::delete('/borrowings/{id}', [UserBorrowingsController::class, 'destroy'])->name('borrowings.destroy');

        // Profile
        Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    });
