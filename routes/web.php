<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CycleSyncHubController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OwnerPanelController;
use App\Http\Controllers\ActivityLogController;
use Illuminate\Support\Facades\Route;

// Strona startowa
Route::get('/', function () {
    return view('index');
})->name('home.index');

// Lista użytkowników (tylko dla admina i ownera – index)
Route::middleware(['auth'])->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
});

// Zarządzanie użytkownikami (tylko admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Panel właściciela
Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner-panel', [OwnerPanelController::class, 'index'])->name('owner.panel');
});

// Logi (tylko admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/logi', [ActivityLogController::class, 'index'])->name('activity_logs.index');
    Route::delete('/logi/wyczysc', [ActivityLogController::class, 'destroyAll'])->name('activity_logs.destroyAll');
});

// Grupa tras do rowerów (CRUD), tylko dla zalogowanych
Route::middleware(['auth'])
    ->prefix('cyclesynchub')
    ->name('cyclesynchub.')
    ->controller(CycleSyncHubController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{bike}/edit', 'edit')->name('edit');
        Route::get('/{bike}', 'show')->name('show');
        Route::put('/{bike}', 'update')->name('update');
        Route::delete('/{bike}', 'destroy')->name('destroy');
        Route::put('/collected/{bike}', 'markAsCollected')->name('collected');
        Route::put('/complete/{bike}', 'complete')->name('complete');
        Route::get('/owner-panel', [CycleSyncHubController::class, 'ownerPanel'])->name('owner.panel')->middleware('role:owner');
        // Usuwanie wszystkich rowerów odebranych (tylko dla ownera)
        Route::delete('/collected/delete-all', 'destroyCollected')->name('destroyCollected')->middleware('role:owner');
    });

// Dashboard (np. Breeze lub Jetstream)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile (Breeze lub Jetstream)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
