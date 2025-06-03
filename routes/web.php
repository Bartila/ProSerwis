<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CycleSyncHubController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BikeTypeController;
use App\Http\Controllers\BikeComponentController;
use App\Http\Controllers\OwnerPanelController;

// Strona startowa
Route::get('/', function () {
    return view('index');
})->name('home.index');

// Panel użytkowników (tylko admin/owner)
Route::middleware(['auth', 'role:admin,owner'])->group(function () {
    Route::resource('users', UserController::class)->only(['index', 'create', 'store', 'destroy']);
});



Route::middleware(['auth'])->group(function () {
    Route::get('/owner-panel', [OwnerPanelController::class, 'index'])->name('owner.panel');
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
        Route::put('/complete/{bike}', 'complete')->name('complete'); // <<<<<< POPRAWNA TRASA!
        Route::get('/owner-panel', [CycleSyncHubController::class, 'ownerPanel'])->name('owner.panel')->middleware('role:owner');

    });

// Dashboard (domyślnie z Breeze lub Jetstream)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile (z Breeze lub Jetstream)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
