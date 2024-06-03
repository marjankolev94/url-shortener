<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UrlController::class, 'index']);
Route::get('url/create', [UrlController::class, 'create']);
Route::get('url/edit/{url}', [UrlController::class, 'edit']);
Route::put('url/update/{url}', [UrlController::class, 'update']);
Route::delete('url/delete/{url}', [UrlController::class, 'destroy']);
Route::post('url', [UrlController::class, 'store']);
