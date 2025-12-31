<?php

use App\Http\Controllers\user\GuestUserController;
use Illuminate\Support\Facades\Route;
use Phiki\Phast\Root;


Route::get('/', [GuestUserController::class, 'index'])->name('index');


// Route::get('/index', function () {
//     return view('index');
// })->name('index');