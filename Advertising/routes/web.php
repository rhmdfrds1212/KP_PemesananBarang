<?php

use App\Http\Controllers\LokasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.main');
});

Route::resource('lokasi', LokasiController::class);