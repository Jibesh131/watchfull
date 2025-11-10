<?php

use App\Http\Controllers\creator\content\CreatorContentController;
use App\Http\Controllers\creator\CreatorController;
use Illuminate\Support\Facades\Route;

// Prefix - creator || declear in bootstrap/app.php
Route::as('creator.')->group(function () {
    Route::get('/', [CreatorController::class, 'index'])->name(('dashboard'));
    Route::get('/my-content', [CreatorContentController::class, 'index'])->name(('content'));
    Route::get('/my-content/add', [CreatorContentController::class, 'add'])->name(('add.content'));
    // Route::post('/my-content/add', [CreatorController::class, 'addContent'])->name(('add.content'));
    // Route::get('/my-content/add', [CreatorController::class, 'addContent'])->name(('add.content'));
    // Route::get('/my-content/add', [CreatorController::class, 'addContent'])->name(('add.content'));
});
