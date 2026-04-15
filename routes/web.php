<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.beranda.index');
})->name('beranda');

Route::get('/buku', function () {
    return view('pages.buku.index');
})->name('buku');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
})->name('dashboard');

Route::get('/anggota', function () {
    return view('pages.anggota.index');
})->name('anggota');

Route::get('/peminjaman', function () {
    return view('pages.peminjaman.index');
})->name('peminjaman');

Route::get('/petugas', function () {
    return view('pages.petugas.index');
})->name('petugas');

?>