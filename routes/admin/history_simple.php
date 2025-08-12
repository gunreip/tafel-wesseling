<?php

/**
 * Admin Routes – History Feature (Simple List View)
 *
 * Enthält die Routen für die einfache Listenansicht des Änderungsverlaufs.
 * Diese Ansicht listet Aktivitäten aus Spatie Activitylog mit Filteroptionen.
 *
 * Konvention:
 * - Feature-Präfix im Dateinamen (history_simple.php) für klare Zuordnung.
 * - Prefix 'admin' und Name 'admin.' für konsistente Admin-Route-Namen.
 */

use App\Http\Controllers\Admin\ActivityLogController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'can:viewActivityLog'])
    ->prefix('admin')->name('admin.')
    ->group(function () {
        Route::get('/history', [ActivityLogController::class, 'index'])
            ->name('history.index');
    });
