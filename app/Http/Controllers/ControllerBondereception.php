<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bondereception;
use App\Models\Mouvement;
use App\Models\Departement;
use Illuminate\Support\Carbon;

class ControllerBondereception extends Controller
{
    //
    public function list(){
        $nom_profil = session('profil');
        $fonction = session('fonction');
        $listBondereception = Bondereception::getList();
        return view('bondereception.list',[
            'nom_profil' => $nom_profil,
            'fonction' => $fonction,
            'list' => $listBondereception
        ]);
    }
    public function ajouterStock($id){
        $dateEtHeureActuellesMadagascar = Carbon::now('Indian/Antananarivo');
        $dateFormateeMadagascar = $dateEtHeureActuellesMadagascar->format('Y-m-d H:i:s');
        $data = array(
            'id_bondereception' => $id,
            'idmagasin' => 1,
            'date' => $dateFormateeMadagascar
        );
        Mouvement::insert($data);
        return redirect()->route('depot');
    }
    public function voirDepot(){
        $nom_profil = session('profil');
        $fonction = session('fonction');
        $listProduit = Bondereception::getDepot();
        return view('depot.list',[
            'nom_profil' => $nom_profil,
            'fonction' => $fonction,
            'listProduit' => $listProduit
        ]);
    }
    public function partager_produit($id){
        $depot = Bondereception::getById($id);
        $depart = new Departement();
        $listDepartement = $depart->getAllDepartement();
        $nom_profil = session('profil');
        $fonction = session('fonction');
        return view('depot.partage',[
            'nom_profil' => $nom_profil,
            'fonction' => $fonction,
            'produit' => $depot,
            'listDepartement' => $listDepartement
        ]);
    }
    public function insert_partage(Request $request){
        $dateEtHeureActuellesMadagascar = Carbon::now('Indian/Antananarivo');
        $dateFormateeMadagascar = $dateEtHeureActuellesMadagascar->format('Y-m-d H:i:s');
        $idbondereception = $request->input('idbondereception');
        $data = array(
            'id_bondereception' => $idbondereception,
            'iddepartement' => $request->input('departement'),
            'quantite' => $request->input('quantite'),
            'date' => $dateFormateeMadagascar
        );
        $bondereception = Bondereception::getById($idbondereception);
        if($data['quantite'] > $bondereception[0]->quantite){
            $message = "Quantite insuffisant";
            return redirect()->back()->withErrors(['error' => $message])->withInput();
        }else{
            $reste_quantite = $bondereception[0]->quantite - $data['quantite'];
            Bondereception::updateQuantite($idbondereception,$reste_quantite);
            Mouvement::insertPartage($data);
            return redirect()->route('depot');
        }
    }
}
