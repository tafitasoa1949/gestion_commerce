<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Besoin extends Model
{
    use HasFactory;
    public static function besoinEnCours(){
        $result = DB::select("select * from besoinencours");
        return $result;
    }
}
