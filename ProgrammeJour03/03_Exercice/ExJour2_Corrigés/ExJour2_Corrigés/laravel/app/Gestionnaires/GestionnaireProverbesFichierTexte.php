<?php

namespace App\Gestionnaires;

/**
 * Rend une série de proverbes.
 * Remarque : les proverbes proviennent du fichier : \storage\app\proverbes.txt
 */
class GestionnaireProverbesFichierTexte implements IGestionnaireProverbes {

     /**
     * Récupere tous les proverbes du fichier : \storage\app\proverbes.txt
     * @return type Un tableau contenant tous les proverbes
     */
    public function rendProverbes() {
        $path = storage_path('app/proverbes.txt');
        $proverbes = file($path);
        return $proverbes;
    }
    
    /**
     * Permet de savoir d'où proviennent les proverbes
     * @return string "Source : Proverbes provenant d'un fichier texte"    
     */
    public function rendSource() {
        return "Source : Proverbes provenant d'un fichier texte";
    }
}