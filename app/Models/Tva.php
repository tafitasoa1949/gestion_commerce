<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tva extends Model
{
    use HasFactory;
    public static function getTva(){
        $result = DB::select(" select * from tva order by date desc");
        return $result;
    }
}
