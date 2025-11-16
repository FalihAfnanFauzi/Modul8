<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;


// ... Route Welcome ...

// GROUP ROUTE YANG DILINDUNGI (AUTH)
Route::middleware('auth')->group(function () {
    Route::resource('mahasiswa', MahasiswaController::class)->except(['show']); //

Route::get('/mahasiswa/get-data', [MahasiswaController::class, 'getData'])
    ->name('mahasiswa.get-data');


    // Route Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Route Profil & Users (sudah benar)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Route Upload (sudah benar)
    Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');
    Route::delete('/upload/{upload}', [UploadController::class, 'destroy'])->name('upload.destroy');
});


// ROUTE AUTENTIKASI (WAJIB DITAMBAHKAN KEMBALI)
require __DIR__.'/auth.php';
