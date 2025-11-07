<?php

use App\Http\Controllers\creator\CreatorController;
use Illuminate\Support\Facades\Route;

// Prefix - creator || declear in bootstrap/app.php
Route::as('creator.')->group(function () {
    Route::get('/', [CreatorController::class, 'index'])->name(('dashboard'));
});
