<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Articel\ArticelController;
use App\Http\Controllers\Kategori\KategoriController;



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

Route::get('/', [ArticelController::class, 'list']);

Route::get('/Artikel/{id}', [ArticelController::class, 'view']);

Auth::routes();



Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/Artikel', [ArticelController::class, 'index'])->name('artikel');
    Route::post('/Artikel', [ArticelController::class, 'store'])->name('artikel-post');
    Route::put('/Artikel', [ArticelController::class, 'update'])->name('artikel-post');
    Route::delete('/Artikel', [ArticelController::class, 'delete'])->name('artikel-post');

    Route::get('/Kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::post('/Kategori', [KategoriController::class, 'store'])->name('kategori-post');
    Route::put('/Kategori', [KategoriController::class, 'update'])->name('kategori-post');
    Route::delete('/Kategori', [KategoriController::class, 'delete'])->name('kategori-post');
});
