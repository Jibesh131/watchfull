<?php

use App\Http\Controllers\creator\content\CreatorContentController;
use App\Http\Controllers\creator\CreatorController;
use Illuminate\Support\Facades\Route;

// Prefix - creator || declear in bootstrap/app.php
Route::as('creator.')->group(function () {
    Route::get('/', [CreatorController::class, 'index'])->name(('dashboard'));

    Route::prefix('/my-content')->name('content.')->group(function () {
        Route::get('/', [CreatorContentController::class, 'index'])->name('index');
        Route::get('/add', [CreatorContentController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [CreatorContentController::class, 'edit'])->name('edit');
        Route::get('/delete/{id}', [CreatorContentController::class, 'delete'])->name('delete');
    });
});

// Route::post('/my-content/add', [CreatorController::class, 'addContent'])->name(('add.content'));
// Route::get('/my-content/add', [CreatorController::class, 'addContent'])->name(('add.content'));
// Route::get('/my-content/add', [CreatorController::class, 'addContent'])->name(('add.content'));