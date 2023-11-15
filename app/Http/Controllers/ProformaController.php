<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Besoin;
use App\Models\Proforma;

class ProformaController extends Controller
{
    //
    public function voirBesoinEnCours(){
        $listBesoin = Besoin::besoinEnCours();
        return view('proforma.besoin',[
            'besoins' => $listBesoin
        ]);
    }
    public function voirProforma($id){
        $proformas = Proforma::getByIdBesoin($id);
        return view('proforma.list',[
            'proformas' => $proformas
        ]);
    }
    public function getDetail($id){
        $details = Proforma::getDetail($id);
        return view('proforma.detail',[
            'details'=>$details
        ]);
    }
}
