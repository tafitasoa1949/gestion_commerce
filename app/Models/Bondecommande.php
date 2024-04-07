<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bondecommande extends Model
{
    protected $table = "bondecommande";
    use HasFactory;
    public static function insertBondecommande($data){
        $id = DB::table('bondecommande')->insertGetId([
            'idproforma'=> $data['idproforma'],
            'montant_total'=> $data['montant_total'],
            'date' => $data['date']
        ]);
        return $id;
    }
    public static function insertDetail($data){
        DB::table('detail_bondecommande')->insert([
            'idbondecommande'=> $data['idbondecommande'],
            'idproduitfournisseur'=> $data['idproduitfournisseur'],
            'quantite' => $data['quantite'],
            'prix_horstaxe' => $data['prix_horstaxe'],
            'tva' => $data['tva']
        ]);
    }
    public static function getList(){
        $result = DB::select("select * from getlistbondecommande");
        return $result;
    }
    public static function getdetails($idbondecommande){
        return DB::select('select * from getdetailbondecommande where idbondecommande=?', [$idbondecommande]);
    }
    public static function getById($idbondecommande){
        return DB::select('select * from getlistbondecommande where id=?', [$idbondecommande]);
    }
}
