<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Rute untuk Client
Route::prefix('clients')->group(function () {
    Route::get('/about', function () {
        return view('clients.about');
    })->name('about');

    Route::get('/dashboardclient', function () {
        return view('clients.dashboard');
    })->name('dashboardclient');

    Route::get('/listbarang', function () {
        return view('clients.listbarang');
    })->name('listbarang');

    Route::get('/loginclient', function () {
        return view('clients.login');
    })->name('loginclient');

    Route::get('/registerclient', function () {
        return view('clients.register');
    })->name('registerclient');
});


// Route::get('/users', function () {
//     return view('users');
// })->middleware(['auth', 'verified'])->name('users');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('items', ItemController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('users', ClientController::class);
});


require __DIR__ . '/auth.php';
