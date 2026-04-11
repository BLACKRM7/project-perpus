<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.beranda.index');
})->name('beranda');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');