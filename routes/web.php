<?php
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); })->name('welcome');

Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', \App\Http\Middleware\EnsureAdmin::class])
    ->prefix('admin')->as('admin.')->group(function () {
        Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');
    });

require __DIR__.'/auth.php';

/**
 * Breeze: Profil-Routen (für Navigation/Dropdown)
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Kundenbereich (sichtbar für role=user und role=admin)
 * Nur Stub-Antworten, Views kommen im nächsten Schritt.
 */
Route::middleware(['auth','can:view-customers'])
    ->prefix('customers')->as('customers.')
    ->group(function () {
        Route::get('/', fn() => view('customers.index'))->name('index');
        Route::get('/create', fn() => view('customers.create'))->name('create');
        Route::get('/{customer}', fn($customer) => response("Kunden – Detail (Stub: $customer)", 200))->name('show');
        Route::get('/{customer}/edit', fn($customer) => response("Kunden – Bearbeiten (Stub: $customer)", 200))->name('edit');
    });
