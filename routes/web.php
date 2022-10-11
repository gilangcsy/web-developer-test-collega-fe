<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth.check']], function () {
    Route::prefix('dashboard/')->namespace('Authentication')->group(function () {
        Route::get('', [DashboardController::class, 'index'])->name('dashboard.index');
    });

    Route::prefix('auth/')->namespace('Authentication')->group(function () {
        Route::delete('/logout', [AuthController::class, 'destroy'])->name('auth.logout');
    });
});

Route::group(['middleware' => ['login.check']], function () {
    Route::prefix('auth/')->namespace('Authentication')->group(function () {
        Route::get('', [AuthController::class, 'index'])->name('auth.index');
        Route::post('', [AuthController::class, 'store'])->name('auth.login');
    });
});


