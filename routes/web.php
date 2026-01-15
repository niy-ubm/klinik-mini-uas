<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QueueController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Semua rute di sini wajib LOGIN
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/admin/dashboard', [QueueController::class, 'adminIndex'])
        ->name('admin.dashboard'); // <--- INI KUNCINYA BUNG!

    Route::post('/admin/call/{doctor_id}', [QueueController::class, 'callNext'])
        ->name('admin.call_next');

    // Dashboard Utama
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // --- RUTE PROFILE (WAJIB ADA BIAR GAK ERROR) ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- RUTE ANTRIAN (USER) ---
    Route::get('/queues', [QueueController::class, 'index'])->name('queues.index');
    Route::get('/queues/create', [QueueController::class, 'create'])->name('queues.create');
    Route::post('/queues', [QueueController::class, 'store'])->name('queues.store');
    Route::patch('/queues/{queue}/cancel', [QueueController::class, 'cancel'])->name('queues.cancel');

    // --- RUTE ADMIN (PEMANGGILAN) ---
    Route::post('/admin/call-next/{doctor_id}', [QueueController::class, 'callNext'])->name('admin.call_next');
});

require __DIR__.'/auth.php';
