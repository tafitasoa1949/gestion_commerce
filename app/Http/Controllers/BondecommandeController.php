<?php

namespace App\Http\Controllers;
use App\Models\Proforma;
use App\Models\Bondecommande;
use App\Models\Tva;
use App\Models\Besoin;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class BondecommandeController extends Controller
{
    //
    public function commande($id){
        $proformas = Proforma::getByIdBesoin($id);
        $dateEtHeureActuellesMadagascar = Carbon::now('Indian/Antananarivo');
        $dateFormateeMadagascar = $dateEtHeureActuellesMadagascar->format('Y-m-d H:i:s');
        $fonction = session('fonction');
        foreach($proformas as $indice){
            $commande = array(
                'idproforma' => $indice->id,
                'montant_total' => $indice->montant,
                'date' => $dateFormateeMadagascar
            );
            $idcommande = Bondecommande::insertBondecommande($commande);
            $detailProforma = Proforma::getDetail($indice->id);
            $tva = Tva::getTva();
            $taux_tva = $tva[0]->taux;
            //dd($taux_tva);
            foreach($detailProforma as $detail){
                // PU * quantite
                $prix_ttc = $detail->prix_ttc * $detail->quantite;
                $prix_hors_taxe = $prix_ttc / (1 + $taux_tva);
                $montant_tva = $prix_ttc - $prix_hors_taxe;
                $data_detail = array(
                    'idbondecommande'=> $idcommande,
                    'idproduitfournisseur'=> $detail->idproduitfournisseur,
                    'quantite' => $detail->quantite,
                    'prix_horstaxe' => $prix_hors_taxe,
                    'tva' => $montant_tva
                );
                Bondecommande::insertDetail($data_detail);
            }
        }
        $datafinie = array(
            'idbesoin'=>$id,
            'date' => $dateFormateeMadagascar
        );
        Besoin::finieBesoin($datafinie);
        return redirect()->route('listbondecommande');
    }
    public function getList(){
        $nom_profil = session('profil');
        $fonction = session('fonction');
        $nom_profil = session('profil');
        $listBondecommande = Bondecommande::getList();
        return view('bondecommande.list',[
            'list' => $listBondecommande,
            'fonction' => $fonction,
            'nom_profil' => $nom_profil
        ]);
    }
    public function voirDetail($id){
        $fonction = session('fonction');
        $nom_profil = session('profil');
        $bondecommande = Bondecommande::getById($id);
        $listdetail = Bondecommande::getdetails($id);
        return view('bondecommande.detail',[
            'bondecommande' => $bondecommande,
            'listdetail' => $listdetail,
            'fonction' => $fonction,
            'nom_profil' =>$nom_profil
        ]);
    }
    //
    public function convertToWords($number) {
        $units = ['', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf', 'dix',
                'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix-sept', 'dix-huit', 'dix-neuf'];
        $tens = ['', '', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'soixante-dix', 'quatre-vingt', 'quatre-vingt-dix'];
        $thousands = ['', 'mille', 'million', 'milliard'];

        $words = [];

        $num = (int)$number;
        if ($num == 0) {
            return 'zéro';
        }

        // Gestion de chaque bloc de trois chiffres
        for ($i = 0; $num > 0; $i++) {
            $chunk = $num % 1000;
            $num = floor($num / 1000);

            if ($chunk > 0) {
                $hundreds = floor($chunk / 100);
                $tensUnits = $chunk % 100;

                $chunkWords = [];

                if ($hundreds > 0) {
                    $chunkWords[] = $units[$hundreds] . ' cent';
                }

                if ($tensUnits > 0) {
                    if ($tensUnits < 20) {
                        $chunkWords[] = $units[$tensUnits];
                    } else {
                        $tensDigit = floor($tensUnits / 10);
                        $unitDigit = $tensUnits % 10;

                        $chunkWords[] = $tens[$tensDigit];

                        if ($unitDigit > 0) {
                            $chunkWords[] = $units[$unitDigit];
                        }
                    }
                }

                $chunkWords[] = $thousands[$i];

                $words[] = implode(' ', array_reverse($chunkWords));
            }
        }

        return implode(' ', array_reverse($words));
    }
    //
    public function exportPDF($id){
        $bondecommande = Bondecommande::getById($id);
        $listdetail = Bondecommande::getdetails($id);
        // date actuel
        $dateEtHeureActuellesMadagascar = Carbon::now('Indian/Antananarivo');
        $dateFormateeMadagascar = $dateEtHeureActuellesMadagascar->format('Y-m-d H:i:s');
        $montant_lettre = $this->convertToWords($bondecommande[0]->montant_total);
        $data = [
            'bondecommande' => $bondecommande,
            'listdetail' => $listdetail,
            'dateHeureActuelles' =>$dateFormateeMadagascar,
            'montant_lettre' => $montant_lettre
        ];
        $pdf = Pdf::loadView('bondecommande.pdf',$data)->setPaper('a4');
        return $pdf->download('Bon de commande.pdf');
    }
}
