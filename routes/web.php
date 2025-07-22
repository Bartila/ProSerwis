<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CycleSyncHubController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OwnerPanelController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MessageController::class, 'index'])->middleware('auth')->name('home.index');

// 📩 Wiadomości
Route::middleware(['auth'])->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');
    Route::post('/reset-counter', [MessageController::class, 'resetCounter'])->name('messages.resetCounter')->middleware('role:admin,owner');
});

// 👥 Użytkownicy
Route::middleware(['auth'])->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// ⚙️ Panel właściciela
Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner-panel', [OwnerPanelController::class, 'index'])->name('owner.panel');
});

// 🧾 Logi
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/logi', [ActivityLogController::class, 'index'])->name('activity_logs.index');
    Route::delete('/logi/wyczysc', [ActivityLogController::class, 'destroyAll'])->name('activity_logs.destroyAll');
});

// 🚲 Rowery
Route::middleware(['auth'])
    ->prefix('cyclesynchub')
    ->name('cyclesynchub.')
    ->controller(CycleSyncHubController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        // Specyficzne trasy przed dynamicznymi
        Route::put('ready-ajax/{bike}', 'ajaxMarkReady')->name('ajaxReady');
        Route::put('collected/{bike}', 'markAsCollected')->name('collected');
        Route::put('complete/{bike}', 'complete')->name('complete');
        Route::post('send-sms/{bike}', 'sendSms')->name('sendSms');
        Route::delete('collected/delete-all', 'destroyCollected')->name('destroyCollected')->middleware('role:owner');
        Route::get('owner-panel', 'ownerPanel')->name('owner.panel')->middleware('role:owner');
        // Dynamiczne ID – zawsze na końcu!
        Route::get('{bike}/edit', 'edit')->name('edit');
        Route::get('{bike}', 'show')->name('show');
        Route::put('{bike}', 'update')->name('update');
        Route::delete('{bike}', 'destroy')->name('destroy');
    });

// 🔍 QR wyszukiwanie
Route::middleware(['auth'])->get('/qr-szukaj', function () {
    return view('bikes.qr-search');
})->name('qr.search');

Route::middleware(['auth'])->post('/qr-szukaj', [CycleSyncHubController::class, 'findByQr'])->name('qr.lookup');

// 📋 Dashboard i profil
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
