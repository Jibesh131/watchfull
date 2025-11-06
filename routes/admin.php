<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(AdminMiddleware::class)->as('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name(('dashboard'));
});