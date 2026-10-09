<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;

// Ubah halaman utama ('/') agar langsung dialihkan (redirect) ke halaman kategori
Route::get('/', function () {
    return redirect()->route('categories.index');
});

// Route resource untuk fitur CRUD
Route::resource('categories', CategoryController::class);
Route::resource('books', BookController::class);