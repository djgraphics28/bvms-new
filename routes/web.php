<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangayController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/profile-avatar-update', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

Route::resource('barangays', BarangayController::class);
Route::resource('devices', DeviceController::class);
Route::resource('drivers',DriverController::class);
Route::resource('incidents',IncidentController::class);
