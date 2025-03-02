<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gestionnaires\GestionnaireProverbesFichierTexte;
use App\Gestionnaires\GestionnaireProverbesHardcode;
use App\Gestionnaires\GestionnaireProverbesWikipedia;

class ProverbesController extends Controller {

    public function afficheDixProverbesV1() {
        $dixProverbes = ["beaucoup de bruit pour rien",
						 "ce qui doit être sera",
						 "diseur de bons mots, mauvais caractère",
						 "eau trouble ne fait pas miroir",
						 "gober des mouches",
						 "jamais deux sans trois",
						 "mieux vaut être seul que mal accompagné",
						 "ni vu ni connu",
						 "Paris ne s’est pas fait en un jour",
						 "rien ne sert de courir, il faut partir à temps",];
        
        // on transmet les dix proverbes à la vue qui va les afficher
		return view('view_proverbesV1')->with('proverbes', $dixProverbes);
    }
	
	public function afficheDixProverbesV2() {
        $gestionnaire = new GestionnaireProverbesHardcode();
		//$gestionnaire = new GestionnaireProverbesFichierTexte();
        //$gestionnaire = new GestionnaireProverbesWikipedia();
        $proverbes = $gestionnaire->rendProverbes();   
        //        On "pêche" dix proverbes au hasard en codant nous même ...
        //        for ($i = 1; $i <= 10; $i++) {
        //            $taille = sizeof($proverbes);
        //            do {
        //                $index =random_int(0,$taille-1);
        //            } while (!isset($proverbes[$index]));
        //            $proverbe = $proverbes[$index];
        //            unset($proverbes[$index]);
        //            array_push($dixProverbes, $proverbe);
        //        }
        //        
        // ou on pêche dix proverbes au hasard à l'aide des fonctions php
        $dixProverbes = array_map(function($index) use ($proverbes) {
            return $proverbes[$index];
        }, array_rand($proverbes, 10));
        
        // on transmet les dix proverbes à la vue qui va les afficher
        return view('view_proverbesV2', ['source' => $gestionnaire->rendSource(),
            'proverbes' => $dixProverbes]);
    }
	
	
}