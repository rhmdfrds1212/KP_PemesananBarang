<?php

use App\Http\Controllers\LokasiController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.main');
});

Route::resource('lokasi', LokasiController::class);
Route::resource('produk', ProdukController::class);