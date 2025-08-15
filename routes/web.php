<?php

use App\Http\Controllers\Customers\CustomerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('customers', CustomerController::class)
        ->only(['index','create','store','show','edit','update']);
});

require __DIR__.'/auth.php';

// Fachbereich „Kunden“ – nur für angemeldete Nutzer mit Gate 'view-customers'
Route::middleware(['auth','can:view-customers'])->group(function () {
    Route::resource('customers', CustomerController::class)
        ->only(['index','create','store','show','edit','update']);
});

// Admin-Bereich – nur für angemeldete Nutzer mit Gate 'admin-access'
Route::prefix('admin')->name('admin.')->middleware(['auth','can:admin-access'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    // weitere Admin-Routen hier ...
});

// Alt-URL weiterleiten (optional, falls noch Links existieren)
Route::permanentRedirect('/admin/customers', '/customers');
