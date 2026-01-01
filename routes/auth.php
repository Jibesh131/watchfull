<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\GoogleController;
use Illuminate\Support\Facades\Route;

// =========== USER ===========
Route::get('/signup', [AuthController::class, 'userSignUpView'])->name(('auth.user.signup.view'));
Route::post('/signup', [AuthController::class, 'userSignUpPost'])->name(('auth.user.signup.post'));
Route::get('/login', [AuthController::class, 'userLoginView'])->name(('auth.user.login.view'));
Route::post('/login', [AuthController::class, 'userLoginPost'])->name(('auth.user.login.post'));
Route::get('/logout', [AuthController::class, 'userLogout'])->name(('auth.user.logout'));

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name(('auth.google.login'));
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name(('auth.google.callback'));

// =========== ADMIN ===========
Route::get('/admin/login', [AuthController::class, 'adminLoginView'])->name(('auth.admin.login.view'));
Route::post('/admin/login', [AuthController::class, 'adminLoginPost'])->name(('auth.admin.login.post'));

// ========== CREATOR ==========
Route::get('/creator/login', [AuthController::class, 'creatorLoginView'])->name(('auth.creator.login.view'));
Route::post('/creator/login', [AuthController::class, 'creatorLoginPost'])->name(('auth.creator.login.post'));
Route::get('/creator/logout', [AuthController::class, 'creatorLogout'])->name(('auth.creator.logout'));