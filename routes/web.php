<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('events.index');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index'])->middleware('auth')->name('events.index');
    Route::get('/create', [EventController::class, 'create'])->middleware('auth')->name('events.create');
    Route::post('/', [EventController::class, 'store'])->middleware('auth')->name('events.store');
    Route::get('/{id}', [EventController::class, 'show'])->middleware('auth')->name('events.show');
    Route::get('/{id}/register', [EventController::class, 'register'])->middleware('auth')->name('events.registerAttendee');
    Route::post('/{id}/register', [EventController::class, 'storeAttendee'])->middleware('auth')->name('events.storeAttendee');
    Route::get('/{id}/edit', [EventController::class, 'edit'])->middleware('auth')->name('events.edit');
    Route::put('/{id}', [EventController::class, 'update'])->middleware('auth')->name('events.update');
    Route::delete('/{id}', [EventController::class, 'destroy'])->middleware('auth')->name('events.destroy');
});

