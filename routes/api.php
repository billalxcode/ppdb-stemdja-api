<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BeritaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->as('v1')->middleware('api')->group(function() {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function() {
        Route::post('login', [AuthController::class, 'login'])->withoutMiddleware('auth')->name('login');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::group(['prefix' => 'berita', 'as' => 'berita'], function () {
        Route::get('', [BeritaController::class, 'all'])->name('all')->withoutMiddleware('api');
        Route::post('', [BeritaController::class, 'create'])->name('create');
        Route::get('{post_id}', [BeritaController::class, 'getpost'])->name('get')->withoutMiddleware('api');
    });
});