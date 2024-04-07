<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Besoin extends Model
{
    protected $table = 'besoin';
    protected $fillable = ['id', 'iddepartement', 'idmateriel', 'quantite', 'date', 'idstatut'];
    public $timestamps = false;
    public function insertOne($data){
        DB::table('besoin')->insert($data);
    }

    public function getListeFinance(){
        return DB::select('SELECT * from liste_demande where etat = 10');
    }

    public function getListeChef(){
        return DB::select('SELECT * from liste_demande where etat = 0');
    }


    public function getDemandeConfirmer(){
        return DB::select('SELECT ld.*
        FROM liste_demande ld
        LEFT JOIN finie f ON ld.id = f.idbesoin
        WHERE f.idbesoin IS NULL AND ld.etat = 20');
    }

    public function updateEtat($id,$etat) {
        $this->where('id', $id)->update(['idstatut' => $etat]);
    }

    public static function finieBesoin($data){
        DB::table('finie')->insert([
            'idbesoin'=> $data['idbesoin'],
            'date'=> $data['date']
        ]);
    }

    public static function besoinEnCours(){
        $result = DB::select("select * from besoinencours");
        return $result;
    }
}
