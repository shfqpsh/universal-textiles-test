<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/add-new-pack-size', [App\Http\Controllers\PagesController::class, 'addNewPackSize']);

Route::post('/addNewPackSize', [App\Http\Controllers\PagesController::class, 'insertNewPackSize']);

Route::get('/list-pack-size', [App\Http\Controllers\PagesController::class, 'listPackSize']);

Route::post('/deletePackSize', [App\Http\Controllers\PagesController::class, 'deletePackSize']);

Route::get('/update/{id}', [App\Http\Controllers\PagesController::class, 'getUpdate']);

Route::post('/updatePackSize', [App\Http\Controllers\PagesController::class, 'updatePackSize']);

Route::post('/place-order', [App\Http\Controllers\HomeController::class, 'placeOrder']);