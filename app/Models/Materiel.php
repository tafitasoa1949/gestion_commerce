<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;
    protected $table = 'materiel';
    protected $fillable = ['id', 'nom', 'iddepartement'];



    public function getAllMateriel(){
        return $this->all();
    }
}
