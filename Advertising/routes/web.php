<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('home');
});

Route::resource('home', HomeController::class);
Route::resource('produk', ProdukController::class);