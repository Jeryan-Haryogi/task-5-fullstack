<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\PassportAuthController;
use App\Http\Controllers\Articel\ArticelController;
use App\Http\Controllers\Kategori\KategoriController;


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
    

Route::post('/register', [PassportAuthController::class, 'register']);
Route::post('/login', [PassportAuthController::class, 'login']);

Route::get('/', [ArticelController::class, 'api_list']);
Route::get('/Artikel', [ArticelController::class, 'api_index'])->name('artikel');
Route::get('/Artikel/{id}', [ArticelController::class, 'api_view']);

Route::middleware('auth:api')->group(function(){
    Route::post('/Artikel', [ArticelController::class, 'api_store'])->name('artikel-post');
    Route::put('/Artikel/{id}', [ArticelController::class, 'api_update']);
    Route::delete('/Artikel/{id}', [ArticelController::class, 'api_delete']);

    Route::post('/Kategori', [KategoriController::class, 'api_store'])->name('kategori-post');
    Route::get('/Kategori', [KategoriController::class, 'api_index'])->name('kategori');
    Route::get('/Kategori/{id}', [KategoriController::class, 'api_detail'])->name('kategori-post');
    Route::put('/Kategori/{id}', [KategoriController::class, 'api_update'])->name('kategori-post');
    Route::delete('/Kategori/{id}', [KategoriController::class, 'api_delete'])->name('kategori-post');
});

