<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Proforma extends Model
{
    use HasFactory;

    public function getBesoin($id){
       $query = "SELECT * from liste_demande where etat = 20 and id = ?";
       $result = DB::select($query, [$id]);
       return $result;
    }
    public function GetProduitFournisseur($materiel)
    {
        $query = "SELECT * from gePproduit_fournisseur where produit = ? limit 1";
        $result = DB::select($query, [$materiel]);
        return $result;
    }

    public static function getByIdBesoin($idbesoin){
        return DB::select('select * from getproforma where idbesoin=?', [$idbesoin]);
    }



    public static function getBy($materiel){
        $materiels = trim($materiel);
        $query = "SELECT * from gePproduit_fournisseur where produit = ? limit 1";
        $result = DB::select($query, [$materiels]);
        return $result;
    }



    public static function getDetail($id){
        return DB::select('select * from getdetailproforma where idproforma=?', [$id]);
    }

    // public static function SuppDemande($id_besoin){
    //      DB::select('DELETE FROM besoin WHERE id=?', [$id_besoin]);
    // }

    public static function insertProforma($data){
        $id = DB::table('proforma')->insertGetId([
            'idbesoin'=> $data['id_besoin'],
            'idfournisseur'=> $data['idfournisseur'],
            'montant'=> $data['montant'],
            'date' => $data['date']
        ]);
        return $id;
    }

    public static function insertProformaDetail($data1){
        DB::table('detail_proforma')->insert([
            'idproforma'=> $data1['idproforma'],
            'idproduitfournisseur'=> $data1['id_porduit_fournisseur'],
            'quantite' => $data1['quantite'],
            'prix_ttc' => $data1['prix']
        ]);
    }
}
