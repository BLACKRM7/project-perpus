<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\AnggotaController;

Route::get('/', function () {
    return view('pages.user.beranda.index');
})->name('beranda');

Route::get('/buku', function () {
    return view('pages.user.buku.index');
})->name('buku');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::resource('buku', App\Http\Controllers\BukuController::class);
Route::resource('petugas', App\Http\Controllers\PetugasController::class);
Route::resource('anggota', App\Http\Controllers\AnggotaController::class);
