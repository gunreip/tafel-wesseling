<?php

/**
 * Admin Routes – History Feature (Basisrouten)
 *
 * Diese Datei dient als zentraler Einstiegspunkt für das Feature "History" (Änderungsverlauf).
 * Hier können künftig zusätzliche Endpunkte wie Detailansichten oder Exporte ergänzt werden.
 *
 * Konvention:
 * - Dateiname mit Feature-Präfix (history_routes.php) zur eindeutigen Tab-Erkennung im Editor.
 * - Prefix 'admin' und Name 'admin.' für konsistente Admin-Route-Namen.
 * - Alle Labels im UI auf Deutsch, interne Bezeichner en-US.
 */

use Illuminate\Support\Facades\Route;

// Beispiel für spätere Routen:
// Route::middleware(['auth', 'can:viewActivityLog'])
//     ->prefix('admin')->name('admin.')
//     ->group(function () {
//         Route::get('/history/{activity}', [\App\Http\Controllers\Admin\ActivityLogController::class, 'show'])
//             ->name('history.show');
//     });
