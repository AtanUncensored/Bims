<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LguController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('lgu.index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    // LGU (superAdmin) Routes
    Route::middleware(['role:superAdmin'])->group(function () {
        Route::get('/lgu', [LguController::class, 'index'])->name('lgu.index');
        Route::get('/lgu/create-barangay', [LguController::class, 'createBarangayForm'])->name('lgu.create-barangay');
        Route::post('/lgu/store-barangay', [LguController::class, 'storeBarangay'])->name('lgu.store-barangay');
    });

    // Barangay (admin) Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/barangay', [BarangayController::class, 'index'])->name('barangay.index');
        Route::get('/barangay/create-user', [BarangayController::class, 'createUserForm'])->name('barangay.create-user');
        Route::post('/barangay/store-user', [BarangayController::class, 'storeUser'])->name('barangay.store-user');
    });

    // User Routes
    Route::middleware(['role:user'])->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
    });
});

require __DIR__.'/auth.php';
