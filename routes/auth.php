<?php

use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;

// =========== USER ===========
Route::get('/user/login', [AuthController::class, 'userLoginView'])->name(('auth.user.login.view'));
Route::post('/user/login', [AuthController::class, 'userLoginView'])->name(('auth.user.login.view'));

// =========== ADMIN ===========
Route::get('/admin/login', [AuthController::class, 'adminLoginView'])->name(('auth.admin.login.view'));
Route::post('/admin/login', [AuthController::class, 'adminLoginPost'])->name(('auth.admin.login.post'));

// ========== CREATOR ==========
Route::get('/creator/login', [AuthController::class, 'creatorLoginView'])->name(('auth.creator.login.view'));
Route::post('/creator/login', [AuthController::class, 'creatorLoginPost'])->name(('auth.creator.login.post'));