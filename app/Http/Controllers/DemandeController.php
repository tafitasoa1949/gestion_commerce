<?php

namespace App\Http\Controllers;

use App\Models\Besoin;
use App\Models\Departement;
use App\Models\Materiel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DemandeController extends Controller
{
    //
    public function index()
    {
        $departement = new Departement();
        $materiel = new Materiel();
        $nom_profil = session('profil');
        $fonction = session('fonction');
        $departements = $departement->getAllDepartement();
        $materiels = $materiel->getAllMateriel();
        $nom_profil = session('profil');
        $depart = session('iddepart');
        return view('demande.index',
            [
                'departements' => $departements,
                'materiels' => $materiels,
                'nom_profil' => $nom_profil,
                'depart' => $depart,
                'nom_profil' => $nom_profil,
                'fonction' => $fonction
            ]);
    }

    public function insert(Request $request) {
        $data = $request->all();
        $date_of_today = date("Y-m-d H:i:s");
        $besoin = new Besoin();
        for ($i = 0; $i < count($data['id_article']); $i++) {
            $dataOne = [
                'iddepartement' => $data['id_departement'],
                'idmateriel' => $data['id_article'][$i],
                'quantite' => $data['quantite'][$i],
                'date' => $date_of_today,
                'idstatut' => 0
            ];
            $besoin->insertOne($dataOne);
        }
        //return redirect()->route('demande');
    }

    public function listeDemande(){
        $besoin = new Besoin();
        $nom_profil = session('profil');
        $fonction = session('fonction');
        if($fonction == 2) {
            $listeDemande = $besoin->getListeFinance();
            return view('demande.liste',
            [
                'nom_profil' => $nom_profil,
                'listeDemande' => $listeDemande,
                'fonction' => $fonction
            ]);
        } elseif ($fonction == 4) {
            $listeDemande = $besoin->getListeChef();
            return view('demande.liste',
            [
                'nom_profil' => $nom_profil,
                'listeDemande' => $listeDemande,
                'fonction' => $fonction
            ]);
        }

    }

    public function insertConfirmation($id, $etat){

        if($etat == 'chef'){
            $etat = 10;
        } elseif($etat == 'finance') {
            $etat = 20;
        }
        $besoin = new Besoin();
        $besoin->updateEtat($id,$etat);

        return redirect()->route('liste');

    }

    public function DemandeC(){
        $besoin = new Besoin();
        $nom_profil = session('profil');
        $fonction = session('fonction');
        $listeDemande = $besoin->getDemandeConfirmer();
        return view('demande.demandeConfirmer',
        [
            'nom_profil' => $nom_profil,
            'listeDemande' => $listeDemande,
            'fonction' => $fonction
        ]);
    }
}
