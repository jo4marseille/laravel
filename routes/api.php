<?php

use App\Http\Controllers\AssoController;
use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('/assos', [AssoController::class, 'index']);
// Route::post('/assos/create', [AssoController::class, 'store']);


Route::get('/sites', [SiteController::class, 'index']);
Route::get('/sites/{site}', [SiteController::class, 'show']);

Route::get('/assos', [AssoController::class, 'index']);
Route::get('/assos/search', [AssoController::class, 'search']);
Route::get('/assos/{slug}', [AssoController::class, 'show']);
// Route::post('/sites/create', [SiteController::class, 'store']);
