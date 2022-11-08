<?php

use App\Http\Controllers\AssoController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

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
})->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/assos/create', [AssoController::class, 'create'])->name('assos.create');
Route::post('/assos/create', [AssoController::class, 'store'])->name('assos.store');

Route::get('/sites/create', [SiteController::class, 'create'])->name('sites.create');
Route::post('/sites/create', [SiteController::class, 'store'])->name('sites.store');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/assos', [AssoController::class, 'indexAdmin'])->name('assos');
    Route::get('/assos/new', [AssoController::class, 'createAdmin'])->name('assos.createAdmin');
    Route::get('/assos/edit/{assoId}', [AssoController::class, 'edit'])->name('assos.edit');
    Route::delete('/assos/delete/{asso}', [AssoController::class, 'delete'])->name('assos.delete');

    Route::get('/sites', [SiteController::class, 'indexAdmin'])->name('sites');
    Route::get('/sites/new', [SiteController::class, 'createAdmin'])->name('sites.createAdmin');
    Route::get('/sites/edit/{siteId}', [SiteController::class, 'edit'])->name('sites.edit');
    Route::delete('/sites/delete/{site}', [SiteController::class, 'delete'])->name('sites.delete');

});

