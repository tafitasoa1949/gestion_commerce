<?php

use App\Http\Controllers\DemandeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProformaController;
use App\Http\Controllers\BondecommandeController;
use App\Http\Controllers\ControllerBondereception;
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

//login
Route::get('/', [LoginController::class,'index']);
Route::post('/verificationUsers', [LoginController::class,'control'])->name('verificationUsers');
//Demande
Route::get('/demande', [DemandeController::class,'index'])->name('demande');
Route::post('/demander', [DemandeController::class,'insert'])->name('demander');
Route::get('/liste', [DemandeController::class,'listeDemande'])->name('liste');
Route::get('Confirmation/{id}/{etat}',[DemandeController::class,'insertConfirmation'])->name('Confirmation');
Route::get('/DemandeConfirmer', [DemandeController::class,'DemandeC'])->name('DemandeConfirmer');

// proforma
Route::get('listeproforma/{id}', [ProformaController::class,'index'])->name('listeproforma');
Route::get('/proforma', [ProformaController::class,'voirBesoinEnCours'])->name('proforma');
Route::get('proforma/{id}', [ProformaController::class,'voirProforma']);
Route::get('detail_proforma/{id}', [ProformaController::class,'getDetail']);

// bon de commande
Route::get('bondecommande/{id}', [BondecommandeController::class,'commande']);
Route::get('/listbondecommande', [BondecommandeController::class,'getList'])->name('listbondecommande');
Route::get('detailbondecommande/{id}', [BondecommandeController::class,'voirDetail']);
Route::get('pdfbondecommande/{id}', [BondecommandeController::class,'exportPDF']);

//bon de reception
Route::get('/listbondereception', [ControllerBondereception::class,'list'])->name('listbondereception');
Route::get('ajoute_stock/{id}', [ControllerBondereception::class,'ajouterStock']);
//depot
Route::get('/depot', [ControllerBondereception::class,'voirDepot'])->name('depot');
Route::get('partager_produit/{id}', [ControllerBondereception::class,'partager_produit'])->name('partager_produit');
Route::get('/insert_partage', [ControllerBondereception::class,'insert_partage'])->name('insert_partage');
