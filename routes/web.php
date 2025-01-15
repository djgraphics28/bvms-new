<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangayController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('barangays', BarangayController::class);
