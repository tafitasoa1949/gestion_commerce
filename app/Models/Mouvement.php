<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mouvement extends Model
{
    use HasFactory;
    public static function insert($data){
        DB::table('mouvementachat')->insert([
            'id_bondereception'=> $data['id_bondereception'],
            'idmagasin'=> $data['idmagasin'],
            'date' => $data['date']
        ]);
    }
    public static function insertPartage($data){
        DB::table('partage_dept')->insert([
            'id_bondereception'=> $data['id_bondereception'],
            'iddepartement'=> $data['iddepartement'],
            'quantite'=> $data['quantite'],
            'date' => $data['date']
        ]);
    }
}
