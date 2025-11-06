<?php

use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/user/login', [AuthController::class, 'userLoginView'])->name(('user.login'));


// =========== ADMIN ===========
Route::get('/admin/login', [AuthController::class, 'adminLoginView'])->name(('auth.admin.login.view'));
Route::post('/admin/login', [AuthController::class, 'adminLoginPost'])->name(('auth.admin.login.post'));
