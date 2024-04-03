<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\Livre\LivreController;
use Illuminate\Support\Facades\Route;

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

// Accueil
Route::get('/', [AccueilController::class, 'index'])->name('accueil');

// // Livre
Route::get('livre/json', [LivreController::class, 'json'])->name('livre.json');
Route::get('livre/{livre}/undelete', [LivreController::class, 'undelete'])->withTrashed()->name('livre.undelete');
Route::resource('livre', LivreController::class);

require __DIR__.'/auth.php';
