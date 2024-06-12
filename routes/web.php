<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\RoomController;
use App\Http\Controllers\Owner\KosController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/owner/dashboard', [DashboardController::class, 'index'])->name('owner.dashboard');
    Route::get('room/create/{kosId}', [RoomController::class, 'create'])->name('room.create');
    Route::post('room/store', [RoomController::class, 'store'])->name('room.store');
    Route::get('kos/create', [KosController::class, 'create'])->name('kos.create');
    Route::post('kos/store', [KosController::class, 'store'])->name('kos.store');
    Route::get('/kos/{kos}/edit', [KosController::class, 'edit'])->name('kos.edit');
    Route::put('/kos/{kos}', [KosController::class, 'update'])->name('kos.update');
    Route::get('/room/{room}/edit', 'RoomController@edit')->name('room.edit');
    Route::put('/room/{room}', [KosController::class, 'update'])->name('room.update');

});