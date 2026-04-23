<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.beranda.index');
})->name('beranda');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::resource('buku', App\Http\Controllers\BukuController::class);
Route::resource('peminjaman', App\Http\Controllers\PeminjamanController::class);