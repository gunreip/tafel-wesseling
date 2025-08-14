<?php

// /home/gunreip/code/tafel-wesseling/routes/admin/customers.php

// routes/admin/customers.php ODER in routes/web.php:
use App\Http\Controllers\Admin\CustomerController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('customers', CustomerController::class)->only(['index','create','store','show','edit','update']);
});
