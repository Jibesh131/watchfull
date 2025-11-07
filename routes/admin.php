<?php

use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Route;

// Prefix - backend, middleware - AdminMiddleware || declear in bootstrap/app.php
Route::as('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name(('dashboard')); 
});