<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;

class LoginController extends Controller
{
    //
    public function index(){
        return view('login.index');
    }
    public function control (Request $request) {
        $login = new Login();
        $resultats = $login->GetUsers();
        $email = $request->input('email');
        $mdp = $request->input('mdp');

       // dd($email, $mdp);

        try{
            foreach ($resultats as $resultat) {
                $idutilisateur = $resultat->employe_id;
                $emailB = $resultat->email;
                $mdpB = $resultat->mdp;
                $profil =$resultat->fonction;
                $iddepart = $resultat->iddepartement;
                $fontion = $resultat->id;

                //dd($idutilisateur, $emailB, $mdpB, $profil,$iddepart);

                if ($email == $emailB && $mdp == $mdpB) {

                    session(['idutilisateur' => $idutilisateur, 
                    'profil' => $profil, 
                    'iddepart' =>$iddepart,
                    'fonction' =>$fontion
                ]);

                    $nom_profil = session('profil');

                    return redirect()->route('demande');

                            // if ($nom_profil == 'Admin') {
                            //     return view('admin.home', [
                            //         'list' => $list,
                            //         'nom_profil' => $nom_profil
                            //     ]);
                            // } else {
                            //     return redirect()->route('');
                            // }
                }
            }

            throw new \Exception('Identifiants invalides');
        } catch (\Exception $e) {
            return view('login.index')->with('error', 'Identifiants invalides');
        }
    }
}
