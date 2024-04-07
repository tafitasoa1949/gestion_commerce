<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bondereception extends Model
{
    use HasFactory;
    public static function getList(){
        $result = DB::select("select * from v_bondereception as bon left join mouvementachat as m on m.id_bondereception=bon.id where m.id_bondereception is null order by bon.id desc");
        return $result;
    }
    public static function updateQuantite($id,$quantite){
        DB::select('update bondereception set quantite = ? where id=?', [$quantite,$id]);
    }
    public static function getById($id){
        return DB::select('select * from v_bonderecption where id=?', [$id]);
    }
    public static function getDepot(){
        $result = DB::select("select * from v_depot");
        return $result;
    }
}
