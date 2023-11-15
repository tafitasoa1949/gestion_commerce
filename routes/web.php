<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProformaController;
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

Route::get('/', [LoginController::class,'index']);
// proforma
Route::get('/proforma', [ProformaController::class,'voirBesoinEnCours'])->name('proforma');
Route::get('proforma/{id}', [ProformaController::class,'voirProforma']);
Route::get('detail_proforma/{id}', [ProformaController::class,'getDetail']);
