<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.user.beranda.index');
})->name('beranda');

Route::get('/buku', function () {
    return view('pages.user.buku.index');
})->name('buku');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('pages.admin.dashboard.index');
})->name('dashboard');

Route::get('/anggota', function () {
    return view('pages.admin.anggota.index');
})->name('anggota');

Route::get('/peminjaman', function () {
    return view('pages.user.peminjaman.index');
})->name('peminjaman');

Route::get('/petugas', function () {
    return view('pages.admin.petugas.index');
})->name('petugas');

?>