<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Proforma extends Model
{
    use HasFactory;
    public static function getByIdBesoin($idbesoin){
        return DB::select('select * from getproforma where idbesoin=?', [$idbesoin]);
    }
    public static function getDetail($id){
        return DB::select('select * from getdetailproforma where idproforma=?', [$id]);
    }
}
