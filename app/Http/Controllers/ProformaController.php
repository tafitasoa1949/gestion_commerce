<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Besoin;
use App\Models\Proforma;

class ProformaController extends Controller
{
    //
    public function voirBesoinEnCours(){
        $fonction = session('fonction');
        $nom_profil = session('profil');
        $listBesoin = Besoin::besoinEnCours();
        return view('proforma.besoin',[
            'besoins' => $listBesoin,
            'fonction' => $fonction,
            'nom_profil' => $nom_profil
        ]);
    }
    public function voirProforma($id){
        $fonction = session('fonction');
        $nom_profil = session('profil');
        $proformas = Proforma::getByIdBesoin($id);
        return view('proforma.list',[
            'proformas' => $proformas,
            'fonction' => $fonction,
            'nom_profil' => $nom_profil
        ]);
    }
    public function getDetail($id){
        $fonction = session('fonction');
        $nom_profil = session('profil');
        $details = Proforma::getDetail($id);
        return view('proforma.detail',[
            'details'=>$details,
            'fonction' => $fonction,
            'nom_profil' => $nom_profil
        ]);
    }

    public function index($id){

        try {
            $besoin = new Proforma();
            $resultat = $besoin->getBesoin($id);
            $materiel = $resultat[0]->materiel;
            $id_besoin = $resultat[0]->id;
            $fonction = session('fonction');
            $produits = $besoin->getBy($materiel);
            // $date = $resultat[0]->date;
            $date = date('Y-m-d H:i:s');
    
            $prix = $produits[0]->prix;
            $quantite = $resultat[0]->quantite;
            $montant = $prix * $quantite;
        
            if (!empty($produits) && isset($produits[0])) {
                $fournisseur = $produits[0]->fournisseur;
                $idfournisseur = $produits[0]->id_fournisseur;
                $id_porduit_fournisseur = $produits[0]->id;
    
                $data = array(
                    'id_besoin' => $id_besoin,
                    'idfournisseur' => $idfournisseur,
                    'montant' => $montant,
                    'date' => $date
                );
    
                $idproforma = $besoin->insertProforma($data);
                $data1 = array(
                    'idproforma' => $idproforma,
                    'id_porduit_fournisseur' => $id_porduit_fournisseur,
                    'quantite' => $quantite,
                    'prix' => $prix
                );
                
                $besoin->insertProformaDetail($data1);
                return redirect()->route('proforma');
    
    
            } else {

                return redirect()->route('DemandeConfirmer')->with('error', 'Pas de produits disponibles');
            }
        } catch (\Exception $e) {

            return redirect()->route('DemandeConfirmer')->with('error', 'Proforma introuvable.');

        }
    
        }

    // public function index($id){

    //     $besoin = new Proforma();
    //     $resultat = $besoin->getBesoin($id);
    //     $materiel = $resultat[0]->materiel;
    //     $id_besoin = $resultat[0]->id;
    //     $produits = $besoin->getBy($materiel);
    //     // $date = $resultat[0]->date;
    //     $date = date('Y-m-d H:i:s');

    //     $prix = $produits[0]->prix;
    //     $quantite = $resultat[0]->quantite;
    //     $montant = $prix * $quantite;

    //     if (!empty($produits) && isset($produits[0])) {
    //         $fournisseur = $produits[0]->fournisseur;
    //         $idfournisseur = $produits[0]->id_fournisseur;
    //         $id_porduit_fournisseur = $produits[0]->id;

    //         $data = array(
    //             'id_besoin' => $id_besoin,
    //             'idfournisseur' => $idfournisseur,
    //             'montant' => $montant,
    //             'date' => $date
    //         );

    //         //dd($data);
    //         $idproforma = $besoin->insertProforma($data);
    //         //dd($id);
    //         $data1 = array(
    //             'idproforma' => $idproforma,
    //             'id_porduit_fournisseur' => $id_porduit_fournisseur,
    //             'quantite' => $quantite,
    //             'prix' => $prix
    //         );

    //         $besoin->insertProformaDetail($data1);
    //         //$besoin->SuppDemande($id_besoin);
    //         return redirect()->route('proforma');
    //         //dd($data1);
    //         // dd($montant, $fournisseur,$idfournisseur, $date,$id_produit,$id_besoin);


    //     } else {

    //         dd("pas de produits");
    //     }

    // }

}
