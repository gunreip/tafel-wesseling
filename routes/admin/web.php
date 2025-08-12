<?php // /home/gunreip/code/tafel-wesseling/routes/admin/web.php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Dashboard → vorerst Activity-Log
    return view('admin.activitylog.index');
})->name('dashboard'); // admin.dashboard

Route::get('/activitylog', function () {
    return view('admin.activitylog.index');
})->name('activitylog.index'); // admin.activitylog.index

// Simple Health-Check ohne Blade/Icons
Route::get('/health', fn () => response('OK', 200))->name('health');
